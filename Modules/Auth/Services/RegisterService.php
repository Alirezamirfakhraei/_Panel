<?php

namespace Modules\Auth\Services;


use Modules\User\Models\User;

class RegisterService
{
    public function generateUser($request)
    {
        return User::query()->create([
            'userID' => $request->userID,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
}
