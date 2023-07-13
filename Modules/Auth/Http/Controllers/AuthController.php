<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Auth\Repositories\AuthRepositories;
use Modules\Auth\Services\AuthServices;
use Modules\Users\Models\User;

class AuthController extends Controller
{
    public AuthServices $services ;
    public  AuthRepositories $repositories;

    public function __construct(AuthServices $services , AuthRepositories $repositories)
    {
        $this->services = $services;
        $this->repositories = $repositories;
    }

    public function login()
    {
        return view('auth::login');
    }



}
