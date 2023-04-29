<?php

namespace Modules\Auth\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                return $help->showMessageError(true, 'userID', 'کاربر موردنظر قبلا در سامانه عضو شده است', 401);
            }
            $findUser = User::query()->where('email', $request['email'])->first();
            if ($findUser) {
                return $help->showMessageError(true, 'email', 'ایمیل موردنظر قبلا در سامانه ثبت شده است', 401);
            }
            $user = User::query()->create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
            DB::commit();
            if ($user) {
                return $help->showMessageError(false, ['userID' => $request->userID, 'gender' => $request->gender, 'fullName' => $request->fullName], 'کاربر با موفقیت در سامانه ثبت نام شد', 201);
            } else {
                DB::rollBack();
                return $help->showMessageError(true, null, 'validation error', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \HttpException($e->getMessage(), 401);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('userID', 'password');
        if ($credentials) {
            $token = auth()->attempt($credentials);
            if ($token) {
                $status = User::query()->where('userID', $request['userID'])->update([
                    'status' => User::STATUS_ACTIVE,
                ]);
                if ($status) {
                    return $this->createNewToken($token);
                }
            }
            return false;
        }
    }

    public function createNewToken($token)
    {
        return response()->json([
            'message' => 'کاربر با موفقت وارد شد',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => \auth()->user(),
        ]);
    }

    public function logout()
    {
        $help = new helper();
        \auth()->logout();
        return $help->showMessageError(true, null, 'user logged out', 401);
    }

    public function edit(Request $request)
    {
        try {
            $help = new helper();
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|string',
                'userID' => 'required|string',
                'password' => 'required|string|min:6',
                'role' => 'required|string|between:1,10',
                'gender' => 'required',
                'fullName' => 'required|string|min:2',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $findUser = User::query()->where('userID', $request['userID'])->first();
            if (!$findUser) {
                return $help->showMessageError(false, 'userID', 'کاربر مورد نظر یافت نشد', 401);
            }
            $update = User::query()->where('userID', $request['userID'])->update([
                'email' => $request['email'],
                'fullName' => $request['fullName'],
                'role' => $request['role'],
                'gender' => $request['gender'],
                'password' => bcrypt($request['password']),
            ]);
            DB::commit();
            if ($update) {
                return $help->showMessageError(false, $update, 'ویرایش کاربر با موفقیت انجام شد', 201);
            } else {
                DB::rollBack();
                return $help->showMessageError(true, null, 'ویرایش کاربر با خطا مواجه شد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
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

    public function addUsers(AddUserRequest $request)
    {
        try {
            $help = new helper();
            $validated = $request->validated();
            if ($validated->fails()) {
                return response()->json(['error' => $validated->errors()], 401);
            }
            $findUser = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->first();
            if ($findUser) {
                return $help->showMessageError(false, 'userID', 'کاربر مورد نظر در سامانه ثبت نام کرده است', 401);
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
                return $help->showMessageError(false, $insert, 'کاربر با موفقیت در سامانه ثبت نام شد', 201);
            } else {
                DB::rollBack();
                return $help->showMessageError(true, null, 'ثبت نام کاربر با خطا مواجه شد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }

    public function editUsers(Request $request)
    {

        try {
            $help = new helper();
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|string',
                'userID' => 'required|string',
                'password' => 'required|string|min:6',
                'role' => 'required|string|between:1,10',
                'gender' => 'required',
                'fullName' => 'required|string|min:2',
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
                    return $help->showMessageError(false, $update, 'اطلاعات کاربر با موفقیت در سامانه تغییر یافت', 201);
                } else {
                    DB::rollBack();
                    return $help->showMessageError(true, null, 'ویرایش کاربر با خطا مواجه شد!', 401);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }
}



