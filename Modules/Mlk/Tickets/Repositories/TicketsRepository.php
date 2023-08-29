<?php

namespace Mlk\Tickets\Repositories;

use Illuminate\Support\Facades\DB;

class TicketsRepository
{
    public function query()
    {
        return DB::connection('mysql_second')->table('tickets');
    }

    public function index()
    {
        return $this->query()->latest()->paginate(10);
    }


}