<?php

namespace Mlk\Repairs\Repositories;

use Illuminate\Support\Facades\DB;

class RepairRepo
{

    private function query()
    {
        return DB::connection('mysql_second')->table("repairs");
    }

    public function index()
    {
       return $this->query()->latest()->paginate(20);
    }

    public function findById($id)
    {
        return $this->query()->where('id' , $id)->first();
    }


}