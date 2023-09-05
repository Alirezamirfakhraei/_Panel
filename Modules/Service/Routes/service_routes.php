<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(ServiceController::class)->group(function ($router) {
        $router->get('services', ['uses' => 'ServiceController@index', 'as' => 'services.index']);
    });
});
