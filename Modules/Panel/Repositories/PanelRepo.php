<?php

namespace Modules\Panel\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Modules\Role\Models\Permission;
use Modules\User\Models\User;

class PanelRepo
{

    public function user_count()
    {
        return DB::connection('mysql_second')->table("users")->count();
    }

    public function cat_count()
    {
        return DB::connection('mysql_second')->table("categories")->count();
    }

    public function car_count()
    {
        return DB::connection('mysql_second')->table("cars")->count();
    }

    public function repair_count()
    {
        return DB::connection('mysql_second')->table("repairs")->count();
    }


//    public function getLatestAuthorUsers()
//    {
//        return User::query()->permission(Permission::PERMISSION_AUTHORS)->latest()->limit(4)->get();
//    }

//    public function getLatestArticles()
//    {
//        return Article::query()->latest()->limit(10)->get();
//    }
}
