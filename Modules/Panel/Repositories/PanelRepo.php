<?php

namespace Modules\Panel\Repositories;

use Modules\Category\Models\Category;
use Modules\Role\Models\Permission;
use Modules\User\Models\User;

class PanelRepo
{
    public function user_count()
    {
        return User::query()->count();
    }

    public function cat_count()
    {
        return Category::query()->count();
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
