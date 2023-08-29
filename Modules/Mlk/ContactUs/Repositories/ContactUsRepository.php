<?php

namespace Mlk\ContactUs\Repositories;

use Illuminate\Support\Facades\DB;
use Mlk\ContactUs\Models\ContactUs;

class ContactUsRepository
{

    public function query()
    {
        return DB::connection('mysql_second')->table('contact_us');
    }

    public function index()
    {
        return $this->query()->latest()->paginate(10);
    }

}
