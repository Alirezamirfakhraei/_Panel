<?php

namespace Mlk\Repairs\Services;

use helper;
use Illuminate\Support\Facades\DB;

class RepairService
{

    private function query()
    {
        return DB::connection('mysql_second')->table("repairs");
    }

    public function store($request)
    {
        $findUser = DB::connection('mysql_second')->table("users")->where('userID' , $request['userID'])->first();
        if (!$findUser)
        {
            return to_route('repairs.create')->with(['danger_message' => helper::UserNotFound]);
        }
        $insert = $this->query()->insert([
            'userID' => $request['userID'],
            'telephone' => $request['telephone'],
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'national_code' => $request['national_code'],
            'bcNumber' => $request['bcNumber'],
            'fatherName' => $request['fatherName'],
            'repairID' => $request['repairID'],
            'password' => bcrypt($request['password']),
            'blue_plate' => $request['blue_plate'],
            'submit_plate' => $request['submit_plate'],
            'address' => $request['address'],
            'postal_code' => $request['postal_code'],
        ]);
        if ($insert){
            toast(helper::SubmitRequest, 'success');
        }else{
            toast(helper::NotInsertNewRecorde, 'danger');
        }
        return to_route('repairs.index');
    }

    public function delete($id)
    {
        toast(helper::SubmitRequest, 'success');
        return $this->query()->where('id', $id)->delete();
    }



}