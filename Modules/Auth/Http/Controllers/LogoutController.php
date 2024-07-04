<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Share\Http\Controllers\Controller;

class LogoutController extends Controller
{
//    public function __invoke(): RedirectResponse
//    {
//        Auth::logout();
//        return to_route('login');
//    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.logout');
    }
}
