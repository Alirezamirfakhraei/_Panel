<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\RegisterService;

class RegisterController extends Controller
{
    public function view()
    {
        return view('Auth::register');
    }

    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        $user = $registerService->generateUser($request);
        auth()->loginUsingId($user->id);
        return redirect()->route('login');
    }
}
