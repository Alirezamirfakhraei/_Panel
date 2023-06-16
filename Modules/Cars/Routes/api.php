<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Cars\Http\Controllers\V1\CarsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    Route::controller(CarsController::class)->group(function () {
        //admin
        Route::get('support/cars', 'cars');
        Route::post('support/add/car', 'addCar');
    });
});
