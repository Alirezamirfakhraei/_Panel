<?php

namespace Modules\Auth\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthRepositories
{
    public function users()
    {
        $connection = DB::connection('mysql2')->table('users')->get()->all();
        if ($connection != null) {
            return response()->json(['data' => $connection], 201);
        }
        return false;
    }

    public function userInfo()
    {
       return response()->json(\auth()->user());
    }

}
