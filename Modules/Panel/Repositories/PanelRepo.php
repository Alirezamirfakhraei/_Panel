<?php

namespace Modules\Panel\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Modules\Role\Models\Permission;
use Modules\User\Models\User;

class PanelRepo
{
    public function user_count(): int
    {
        return DB::connection('mysql_second')->table("users")->count();
    }

    public function messages_count(): int
    {
        return DB::connection('mysql_second')->table("contact_us")->count();
    }

    public function car_count(): int
    {
        return DB::connection('mysql_second')->table("cars")->count();
    }

    public function repair_count(): int
    {
        return DB::connection('mysql_second')->table("repairs")->count();
    }

}
