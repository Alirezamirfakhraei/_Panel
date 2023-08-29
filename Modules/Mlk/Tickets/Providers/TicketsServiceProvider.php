<?php

namespace Mlk\Tickets\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mlk\Role\Models\Permission;

class TicketsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Tickets');
        Route::middleware('web')->namespace('Mlk\Tickets\Http\Controllers')->group(__DIR__ . '/../Routes/tickets_routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
    }


    public function boot()
    {
        config()->set('panelConfig.menus.tickets', [
            'url'   => route('tickets.index'),
            'title' => 'تیکت',
            'icon'  => 'ticket',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
