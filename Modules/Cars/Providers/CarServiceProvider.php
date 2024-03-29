<?php

namespace Modules\Cars\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Role\Models\Permission;

class CarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Cars');
        Route::middleware('web')->namespace('Modules\Cars\Http\Controllers')->group(__DIR__ . '/../Routes/car_routes.php');
    }


    public function boot()
    {
        config()->set('panelConfig.menus.cars', [
            'url'   => route('cars.index'),
            'title' => 'وسایل نقلیه',
            'icon'  => 'car',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
