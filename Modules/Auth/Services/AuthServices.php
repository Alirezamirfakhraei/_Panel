<?php

namespace Modules\Auth\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Requests\AddUserRequest;
use Modules\Repairs\Models\Repair;
use Modules\Users\Models\User;
use helper;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class AuthServices
{

    public function store(Request $request)
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
            $request->validate([
                'userID' => 'required|string|max:250',
                'password' => 'required|min:8'
            ]);
            User::query()->create([
                'userID' => $request->userID,
                'password' => Hash::make($request->password)
            ]);
            DB::commit();
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $request->session()->regenerate();
            return redirect()->route('admin')->with('You have successfully registered & logged in!');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpException(401, $e->getMessage());
        }
    }

    public function authenticate(Request $request)
    {
        $username = User::query()->where('userID', $request['userID'])->first();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('admin')->with('You have successfully logged in!');
        }
        if (!$username || !Hash::check($request['password'], $username['password'])) {
            return 'نام کاربری یا رمز عبور اشتباه میباشد';
        } else {
            $request->session()->regenerate();
            auth()->loginUsingId($username['tradeID']);
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



