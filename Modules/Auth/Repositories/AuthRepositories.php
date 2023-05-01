<?php

namespace Modules\Auth\Repositories;

use Illuminate\Support\Facades\DB;
use helper;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AuthRepositories
{

    private function query($request)
    {
        $validator = Validator::make($request->all(), [
            'userID' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $users = DB::connection('mysql2')->table('users')->where('userID' , $userID)->first();
        dd($users);
    }


    public function users(Request $request, $mode)
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
                } elseif ($mode == 'info') {
                    $this->query($request);
                    break;
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
