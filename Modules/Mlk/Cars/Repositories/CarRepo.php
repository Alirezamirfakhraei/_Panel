<?php

namespace Mlk\Cars\Repositories;

use Illuminate\Support\Facades\DB;

class CarRepo
{

    public function index()
    {
       return DB::connection('mysql_second')->table("cars")->latest()->paginate(20);
    }

}