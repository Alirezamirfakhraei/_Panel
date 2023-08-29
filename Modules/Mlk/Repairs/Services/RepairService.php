<?php

namespace Mlk\Repairs\Services;

use helper;
use Illuminate\Support\Facades\DB;
use Mlk\Repairs\Models\Repair;

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
        $findRepair = $this->query()->where('repairID' , $request['repairID'])->first();
        if ($findRepair)
        {
            toast(helper::DuplicateTradeID, 'danger');
            return to_route('repairs.create');
        }
        $insert = $this->query()->insert([
            'userID' => $request['userID'],
            'telephone' => $request['telephone'],
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'national_code' => $request['national_code'],
            'password' => bcrypt($request['password']),
            'bcNumber' => $request['bcNumber'],
            'fatherName' => $request['fatherName'],
            'repairID' => $request['repairID'],
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

    public function update($request, $id)
    {
        $insert = $this->query()->where('id' , $id)->update([
            'userID' => $request['userID'],
            'telephone' => $request['telephone'],
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'national_code' => $request['national_code'],
            'bcNumber' => $request['bcNumber'],
            'fatherName' => $request['fatherName'],
            'repairID' => $request['repairID'],
            'blue_plate' => $request['blue_plate'],
            'submit_plate' => $request['submit_plate'],
            'address' => $request['address'],
            'repairShop' => $request['repairShop'],
            'issue_date' => $request['issue_date'],
            'expiration_date' => $request['expiration_date'],
            'steward' => $request['steward'],
            'date_of_birth' => $request['date_of_birth'],
            'type_of_person' => $request['type_of_person'],
            'type_of_activity' => $request['type_of_activity'],
            'union_degree' => $request['union_degree'],
            'isIc_code' => $request['isIc_code'],
        ]);
        if ($insert){
            $this->query()->where('id' , $id)->update([
                'status' => Repair::STATUS_PENDING,
            ]);
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