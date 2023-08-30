<?php

use Illuminate\Support\Facades\Route;
use Mlk\ContactUs\Http\Controllers\ContactUsController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(ContactUsController::class)->group(function ($router) {
            $router->get('contacts', ['uses' => 'ContactUsController@index', 'as' => 'contactUs.index']);
    });
});