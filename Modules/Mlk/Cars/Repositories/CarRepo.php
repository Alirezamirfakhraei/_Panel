<?php

namespace Mlk\Cars\Repositories;

use Illuminate\Support\Facades\DB;
use Mlk\Category\Models\Category;

class CarRepo
{

    private function query()
    {
        return DB::connection('mysql_second')->table("cars");
    }

    public function index()
    {
       return DB::connection('mysql_second')->table("cars")->latest()->paginate(20);
    }

    public function findAllCategories()
    {
        return DB::connection('mysql_second')->table("categories")->where('parentID' , 0)->get()->toArray();
    }

    public function findAllCompany()
    {
        return DB::connection('mysql_second')->table("categories")->where('parentID' , '!=',0)->get()->toArray();
    }



}