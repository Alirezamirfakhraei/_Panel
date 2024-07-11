<?php

namespace Modules\User\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\Models\User;
use Modules\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Gate::policy(User::class, UserPolicy::class);
        Factory::guessFactoryNamesUsing(static function (string $name) {
            return 'Modules\User\Database\Factories\\' . class_basename($name) . 'Factory';
        });
    }

    protected function registerRoutes(): void
    {
        Route::middleware('web')->namespace('Modules\User\Http\Controllers')->group(function () {
            require __DIR__ . '/../Routes/user_routes.php';
        });
    }

    public function boot()
    {
        $this->registerRoutes();
        config()->set('panelConfig.menus.users',
            [
                'title' => 'کاربران',
                'url' => '#',
                'icon' => 'account',
                'submenu' => [
                    [
                        'icon' => 'account',
                        'title' => 'کاربران',
                        'url' => route('users.index')
                    ],
                    [
                        'icon' => 'account',
                        'title' => 'کاربران غیرفعال',
                        'url' => 'users/create'
                    ],
                ]
            ]);
    }
}
