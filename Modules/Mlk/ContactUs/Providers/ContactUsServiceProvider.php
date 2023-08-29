<?php

namespace Mlk\ContactUs\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mlk\Role\Models\Permission;

class ContactUsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'ContactUs');
        Route::middleware('web')->namespace('Mlk\ContactUs\Http\Controllers')->group(__DIR__ . '/../Routes/contactUs_routes.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
    }


    public function boot()
    {
        config()->set('panelConfig.menus.contactUs', [
            'url'   => route('contactUs.index'),
            'title' => 'تماس با ما',
            'icon'  => 'message',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
