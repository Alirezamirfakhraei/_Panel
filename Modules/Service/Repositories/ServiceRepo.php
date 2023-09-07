<?php

namespace Modules\Service\Repositories;

use helper;
use Illuminate\Support\Facades\DB;

class ServiceRepo
{

    private function query()
    {
        return DB::connection('mysql_second')->table("services");
    }

    public function getServiceRepiar($request)
    {
        return  $this->query()->where('servicerID' , $request->repairID)->where('carID' , $request->carID)->paginate(20);

    }

    public function getServiceUser($request)
    {
        return  $this->query()->where('carID' , $request->carID)->paginate(20);
    }
}