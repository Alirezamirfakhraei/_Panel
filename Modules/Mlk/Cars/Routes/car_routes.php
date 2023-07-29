<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'admin'], static function ($router) {
    $router->get('cars', ['uses' => 'CarsController@index', 'as' => 'cars.index']);
});
