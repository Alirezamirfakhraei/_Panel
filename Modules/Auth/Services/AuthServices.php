<?php

namespace Modules\Auth\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Modules\Users\Models\User;
use helper;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AuthServices
{
    private function showMessage($mode , $message)
    {
         session()->flash($mode , $message);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->userID = $request->userID;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->saveOrFail();
        return redirect()->route('auth.login')->with('Success' , 'ثببت نام با موفقیت انجام شد');
    }


    public function authenticate(Request $request)
    {
        $admin = User::query()->where('userID', $request['userID'])->first();
        if (empty($admin)){
            $this->showMessage('msg' , 'نام کاربری نامعتبر');
            return redirect()->back();
        }
        if (!Hash::check($request['password'], $admin['password'])) {
            return 'نام کاربری یا رمز عبور اشتباه میباشد';
        } else {
            $request->session()->regenerate();
            auth()->loginUsingId($admin['tradeID']);
            return 'ok';
        }
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
            if (!$findUser) {
                return $help->showMessageError('ParameterNotFound', true, 'userID', 'کاربر مورد نظر پیدانشد! ', 401);
            }
            $delete = DB::connection('mysql2')->table('users')->where('userID', $request->userID)->where('api_token', $request->api_token)->delete();
            if ($delete) {
                return $help->showMessageError('Submit', false, null, 'کاربر مورد نظر با موفقت حذف شد ', 401);
            } else {
                return $help->showMessageError('notInsertNewRecorde', true, null, 'کاربر مورد نظر حذف نشد!', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }
}
