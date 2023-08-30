<?php

namespace Modules\Role\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepo
{
    public function all()
    {
        return Permission::all();
    }
}
