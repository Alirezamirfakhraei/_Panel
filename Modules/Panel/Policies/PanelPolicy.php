<?php

namespace Modules\Panel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Role\Models\Permission;
use Modules\User\Models\User;

class PanelPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

//    public function index(User $user)
//    {
//        if ($user->hasPermissionTo(Permission::PERMISSION_PANEL)) {
//            return true;
//        }
//    }
}
