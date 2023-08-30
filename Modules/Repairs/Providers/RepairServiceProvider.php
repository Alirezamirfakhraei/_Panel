<?php

namespace Modules\Repairs\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Role\Models\Permission;

class RepairServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Repairs');
        Route::middleware('web')->namespace('Modules\Repairs\Http\Controllers')->group(__DIR__ . '/../Routes/repair_routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');

    }


    public function boot()
    {
        config()->set('panelConfig.menus.repairs', [
            'url'   => route('repairs.index'),
            'title' => 'اتو سرویس',
            'icon'  => 'account',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
