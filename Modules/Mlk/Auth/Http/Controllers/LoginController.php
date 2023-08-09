<?php

namespace Mlk\Auth\Http\Controllers;

use helper;
use Illuminate\Support\Facades\Auth;
use Mlk\Auth\Http\Requests\LoginRequest;
use Mlk\Share\Http\Controllers\Controller;
use Mlk\User\Models\User;

class LoginController extends Controller
{
    public function view()
    {
        return view('Auth::login');
    }

    public function login(LoginRequest $request)
    {
        $checkUser = User::query()->where('email',$request->email)->where('status' , User::STATUS_ACTIVE)->first();
        if (!$checkUser){
            return redirect()->back()->withErrors(['data_problem' => helper::UserNotActive]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            toast(helper::WelcomeToPanel , 'success');
            return to_route('panel.index');
        }
        return redirect()->back()->withErrors(['data_problem' => helper::WrongData]);
    }
}
