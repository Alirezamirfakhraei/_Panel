<?php

namespace Mlk\Repairs\Repositories;

use Illuminate\Support\Facades\DB;

class RepairRepo
{

    public function index()
    {
       return DB::connection('mysql_second')->table("repairs")->latest()->paginate(20);
    }

}