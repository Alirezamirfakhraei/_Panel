<?php

namespace Modules\Repairs\Repositories;

use Illuminate\Support\Facades\DB;

class RepairRepo
{

    private function query()
    {
        return DB::connection('mysql_second')->table("repairs");
    }

    public function index()
    {
       return $this->query()->latest()->paginate(15);
    }

    public function findById($id)
    {
        return $this->query()->where('id' , $id)->first();
    }


}