<?php

use Illuminate\Support\Facades\Route;
use Mlk\Repairs\Http\Controllers\RepairsController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(RepairsController::class)->group(function ($router) {
        $router->get('repairs', ['uses' => 'RepairsController@index', 'as' => 'repairs.index']);
//        create
        Route::get('repair/add', 'create')->name('repairs.create');
        Route::post('repair/add', 'store')->name('repairs.store');
        //edit
        Route::get('repair/edit/{id}', 'edit')->name('repairs.edit');
        Route::match(['put', 'patch'], 'repair/edit/{id}', 'update')->name('repairs.update');
//        delete
        Route::delete('repair/remove/{id}', 'destroy')->name('repairs.destroy');
//    resource
        Route::resource('repairs', 'RepairsController', ['except' => 'show']);
    });
});