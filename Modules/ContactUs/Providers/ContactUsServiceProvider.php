<?php

namespace Modules\ContactUs\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Role\Models\Permission;

class ContactUsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'ContactUs');
        Route::middleware('web')->namespace('Modules\ContactUs\Http\Controllers')->group(__DIR__ . '/../Routes/contactUs_routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
    }


    public function boot()
    {
        config()->set('panelConfig.menus.contactUs', [
            'url'   => route('contactUs.index'),
            'title' => 'انتقادات و پیشنهادات',
            'icon'  => 'message',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
