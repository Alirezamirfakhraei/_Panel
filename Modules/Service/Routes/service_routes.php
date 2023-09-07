<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(ServiceController::class)->group(function ($router) {
        $router->get('services', ['uses' => 'ServiceController@index', 'as' => 'services.index']);
        $router->get('services/user' , 'ServiceController@serviceUser')->name('services.user');
        $router->get('services/repair' , 'ServiceController@serviceRepair')->name('services.repair');

        $router->post('services/user' , 'ServiceController@getServiceUser')->name('service.users.store');
        $router->post('services/repair' , 'ServiceController@getServiceRepair')->name('service.repairs.store');

    });
});
