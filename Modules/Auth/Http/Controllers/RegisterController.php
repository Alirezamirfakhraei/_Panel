<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\RegisterService;
use Modules\Share\Http\Controllers\Controller;

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
