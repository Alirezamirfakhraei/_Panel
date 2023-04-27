<?php

namespace Modules\Auth\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Http\Requests\AddUserRequest;
use Modules\Auth\Repositories\AuthRepositories;
use Modules\Auth\Services\AuthServices;
use Modules\Users\Models\User;
use helper;

class SupportController extends Controller
{

    public AuthRepositories $repositories;
    public AuthServices $services;

    public function __construct(AuthRepositories $repositories , AuthServices $services)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->repositories = $repositories;
        $this->services = $services;
    }

    //service and operation
    public function register(Request $request)
    {
        return $this->services->register($request);
    }

    public function login(Request $request)
    {
        return $this->services->login($request);
    }

    public function logout()
    {
        return $this->services->logout();
    }

    public function edit(Request $request)
    {
        return $this->services->edit($request);
    }
    public function refresh()
    {
        return $this->services->refresh();
    }

    public function addUsers(AddUserRequest $request)
    {
        return $this->services->addUsers( $request);
    }

    //repository
    public function profile()
    {
        return $this->repositories->profile();
    }

    public function sendUsers()
    {
        return $this->repositories->sendAllUsers();
    }
}
