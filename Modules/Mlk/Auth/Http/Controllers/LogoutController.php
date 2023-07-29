<?php

namespace Mlk\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Mlk\Share\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login');
    }
}
