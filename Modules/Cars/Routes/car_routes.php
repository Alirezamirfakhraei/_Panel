<?php

use Illuminate\Support\Facades\Route;
use Modules\Cars\Http\Controllers\CarsController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(CarsController::class)->group(function ($router) {
        $router->get('cars', ['uses' => 'CarsController@index', 'as' => 'cars.index']);
//        create
        Route::get('cars/add', 'create')->name('cars.create');
        Route::post('cars/add', 'store')->name('cars.store');
        //edit
        Route::get('cars/edit/{id}', 'edit')->name('cars.edit');
        Route::match(['put', 'patch'], 'car/edit/{id}', 'update')->name('cars.update');
//        delete
        Route::delete('cars/remove/{id}', 'destroy')->name('cars.destroy');
//    resource
        Route::resource('cars', 'CarsController', ['except' => 'show']);
    });
});
