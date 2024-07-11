<?php

namespace Modules\Panel\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Panel\Models\Panel;
use Modules\Panel\Policies\PanelPolicy;
use Modules\Role\Models\Permission;

class PanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Panel');
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'panelConfig');
        Route::middleware('web')->namespace('Modules\Panel\Http\Controllers')->group(__DIR__ . '/../Routes/panel_routes.php');
        Gate::policy(Panel::class, PanelPolicy::class);
    }
    public function boot()
    {
        $this->app->booted(static function () {
            config()->set('panelConfig.menus.panel', [
                'title' => 'داشبورد',
                'url' => \route('panel.index'),
                'icon' => 'view-dashboard',
            ]);
        });

    }
}
