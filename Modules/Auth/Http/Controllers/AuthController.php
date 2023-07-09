<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\CreateUserRequest;
use Modules\Auth\Repositories\AuthRepositories;
use Modules\Auth\Services\AuthServices;
use Modules\Users\Models\User;

class AuthController extends Controller
{
    public AuthServices $services;
    public AuthRepositories $repositories;

    public function __construct(AuthServices $services, AuthRepositories $repositories)
    {
        $this->services = $services;
        $this->repositories = $repositories;
    }

    public function login()
    {
        return view('auth::login');
    }

    public function register()
    {
        return view('auth::register');
    }

    public function store(CreateUserRequest $request)
    {
        return $this->services->store($request);
    }
    public function authenticate(Request $request)
    {
        return $this->services->authenticate($request);
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {

    }
}
