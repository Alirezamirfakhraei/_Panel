<?php

namespace Modules\Auth\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\AddUserRequest;
use Modules\Auth\Repositories\AuthRepositories;
use Modules\Auth\Services\AuthServices;

class SupportController extends Controller
{

    public AuthRepositories $repositories;
    public AuthServices $services;

    public function __construct(AuthRepositories $repositories , AuthServices $services)
    {
        $this->repositories = $repositories;
        $this->services = $services;
    }

    public function test()
    {
        return view('auth::index');
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

    public function refresh()
    {
        return $this->services->refresh();
    }

    public function userAdd(AddUserRequest $request)
    {
        return $this->services->userAdd( $request);
    }

    public function userEdit(Request $request)
    {
        return $this->services->userEdit($request);
    }

    public function userDelete(Request $request)
    {
        return $this->services->destroy($request);
    }

    //repository
    public function users(Request $request , $mode)
    {
        return $this->repositories->users($request , $mode);
    }

}
