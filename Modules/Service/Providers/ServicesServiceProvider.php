<?php

namespace Modules\Service\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Role\Models\Permission;

class ServicesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Service');
        Route::middleware('web')->namespace('Modules\Service\Http\Controllers')->group(__DIR__ . '/../Routes/service_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Role');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
    }


    public function boot()
    {
        config()->set('panelConfig.menus.service', [
            'url'   => route('services.index'),
            'title' => 'سرویس ها',
            'icon'  => 'run',
            'permissions' => [Permission::PERMISSION_ROLES]
        ]);
    }
}
