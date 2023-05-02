<?php

namespace Modules\Auth\Repositories;

use Illuminate\Support\Facades\DB;
use helper;
use Illuminate\Support\Facades\Request;
use Modules\Users\Models\User;

class AuthRepositories
{
    private function query($userID)
    {
        $user = DB::connection('mysql2')->table('users')->where('userID', $userID)->first();
        return $user ? true : false;
    }

    public function users($mode)
    {
        $help = new helper();
        $connection = DB::connection('mysql2')->table('users')->get()->all();
        if ($connection != null) {
            $resultArray = [];
            for ($i = 0; $i < count($connection); $i++) {
                if ($mode == 'detail') {
                    $resultArray[$i] = $connection[$i];
                    {
                        $resultArray[$i] = [
                            'address' => $connection[$i]->address,
                            'gender' => $connection[$i]->gender,
                            'email' => $connection[$i]->email,
                            'job' => $connection[$i]->job,
                            'telephone' => $connection[$i]->telephone,
                            'identifiCode' => $connection[$i]->identifiCode,
                        ];
                    }
                } else {
                    $resultArray[$i] = [
                        'userID' => $connection[$i]->userID,
                        'role' => $connection[$i]->role,
                        'name' => $connection[$i]->name,
                        'lastname' => $connection[$i]->lastname,
                        'score' => $connection[$i]->score,
                        'status' => $connection[$i]->status,
                    ];
                }
            }
            return $help->showMessageError('Submit', false, $resultArray, 'اطلاعات با موفقیت ارسال شد', 201);
        }
        return false;
    }


}
