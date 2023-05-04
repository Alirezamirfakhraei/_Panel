<?php

namespace Modules\Auth\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Requests\AddUserRequest;
use Modules\Users\Models\User;
use helper;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AuthServices
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $help = new helper();
            $validator = Validator::make($request->all(), [
                'userID' => 'required|string',
                'password' => 'required|string|confirmed|min:6',
                'role' => 'required|string|between:1,10',
                'gender' => 'required',
                'fullName' => 'required|string|min:2',
                'email' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $findUser = User::query()->where('userID', $request['userID'])->first();
            if ($findUser) {
                return $help->showMessageError('UserNotFound', true, 'userID', 'کاربر موردنظر قبلا در سامانه عضو شده است', 401);
            }
            $findUser = User::query()->where('email', $request['email'])->first();
            if ($findUser) {
                return $help->showMessageError('UserNotFound', true, 'email', 'ایمیل موردنظر قبلا در سامانه ثبت شده است', 401);
            }
            $user = User::query()->create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
            DB::commit();
            if ($user) {
                return $help->showMessageError('Submit', false, ['userID' => $request->userID, 'gender' => $request->gender, 'fullName' => $request->fullName], 'کاربر با موفقیت در سامانه ثبت نام شد', 201);
            } else {
                DB::rollBack();
                return $help->showMessageError('NotInsertNewRecorde', true, null, 'validation error', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        DB::beginTransaction();
        try {
            $help = new helper();
            if (!isset($request['userID']) || !$request['userID']) {
                return $help->showMessageError('ParameterNotSent', true, ['parameter' => 'userID'], 'نام کاربری وارد نشده است', 401);
            }
            if (!isset($request['password']) || !$request['password']) {
                return $help->showMessageError('ParameterNotSent', true, ['parameter' => 'password'], 'رمزعبور وارد نشده است', 401);
            }
            $username = User::query()->where('userID', $request['userID'])->first();
            if (!$username) {
                return $help->showMessageError('ParameterNotFound', true, null, 'کاربر مورد نظر یافت نشد', 401);
            }
            $credentials = $request->only('userID', 'password');
            if ($credentials) {
                $token = auth()->attempt($credentials);
                if (!Hash::check($request['password'], $username['password'])) {
                    return $help->showMessageError('Wrong', true, null, 'نام کاربری یا رمز عبور اشتباه میباشد', 401);
                }
                if ($token) {
                    $user = User::query()->where('userID', $request['userID'])->update([
                        'status' => User::STATUS_ACTIVE,
                    ]);
                    DB::commit();
                    if ($user) {
                        return $this->createNewToken($token);
                    }
                    return false;
                }
                return false;
            } else {
                return $help->showMessageError('IllogicalData', true, null, 'نام کاربری یا رمز عبور اشتباه میباشد', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }

    public function createNewToken($token)
    {
        $result = [
            'code' => 201,
            'error' => false,
            'mode' => 'Submit',
            'message' => 'کاربر با موفقیت وارد شد',
            'data' => ['token' => $token, 'expires_in' => 18 * 60 * 60 * 1000]
        ];
        return response()->json($result);
    }

    public function logout()
    {
        $help = new helper();
        \auth()->logout();
        return $help->showMessageError('Submit', true, null, 'user logged out', 401);
    }

    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (JWTException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        }
        return response()->json(['token' => $newToken]);
    }

    public function userAdd(AddUserRequest $request)
    {
        try {
            $help = new helper();
            $validated = $request->validated();
            if ($validated->fails()) {
                return response()->json(['error' => $validated->errors()], 401);
            }
            $findUser = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->first();
            if ($findUser) {
                return $help->showMessageError('DuplicateRegister', true, 'userID', 'کاربر مورد نظر در سامانه ثبت نام کرده است', 401);
            }
            $insert = DB::connection('mysql2')->table('users')->insert([
                'userID' => $request->userID,
                'api_token' => User::createToken(),
                'name' => $request->name,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'gender' => $request->gender,
                'telephone' => $request->telephone,
            ]);
            DB::commit();
            if ($insert) {
                return $help->showMessageError('Submit', false, $insert, 'کاربر با موفقیت در سامانه ثبت نام شد', 201);
            } else {
                DB::rollBack();
                return $help->showMessageError('NotInsertNewRecorde', true, null, 'ثبت نام کاربر با خطا مواجه شد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }


    public function userEdit(Request $request)
    {
        try {
            $help = new helper();
            $validator = Validator::make($request->all(), [
                'userID' => 'required|string',
                'name' => 'required|string',
                'lastname' => 'required|string|between:1,10',
                'address' => 'required|min:3',
                'gender' => 'required',
                'telephone' => 'required|string|min:2',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $findUser = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->first();
            if ($findUser) {
                $update = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->update([
                    'userID' => $request->userID,
                    'api_token' => User::createToken(),
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'telephone' => $request->telephone,
                ]);
                DB::commit();
                if ($update) {
                    return $help->showMessageError('Submit', false, null, 'اطلاعات کاربر با موفقیت در سامانه تغییر یافت', 201);
                } else {
                    DB::rollBack();
                    return $help->showMessageError('notInsertNewRecorde', true, null, 'ویرایش کاربر با خطا مواجه شد!', 401);
                }
            } else {
                return $help->showMessageError('userNotFound', true, null, 'کاربر مورد نظر وجود ندارد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $help = new helper();
            if (!isset($request['userID']) || $request['userID'] == null) {
                return $help->showMessageError('ParameterNotSend', true, 'userID', 'شماره همراه کاربرارسال نشده است! ', 401);
            }
            if (!isset($request['api_token']) || $request['api_token'] == null) {
                return $help->showMessageError('ParameterNotSend', true, 'api_token', 'توکن کاربرارسال نشده است! ', 401);
            }
            $findUser = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->first();
            if (!$findUser)
            {
                return $help->showMessageError('ParameterNotFound', true, 'userID', 'کاربر مورد نظر پیدانشد! ', 401);
            }
            $delete = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->where('api_token' , $request->api_token)->delete();
            if ($delete){
                return $help->showMessageError('Submit', false, null, 'کاربر مورد نظر با موفقت حذف شد ', 401);
            }else{
                return $help->showMessageError('notInsertNewRecorde', true, null, 'کاربر مورد نظر حذف نشد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }
}



