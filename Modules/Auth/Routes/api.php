<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\V1\SupportController;

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
    Route::controller(SupportController::class)->group(function () {
        //admin
        Route::post('support/register', 'register');
        Route::post('support/login', 'login');
        Route::post('support/logout', 'logout');
        //user
        Route::post('support/user/add', 'userAdd');
        Route::post('support/user/edit', 'userEdit');
        Route::post('support/user/delete', 'userDelete');
        Route::get('support/user/info', 'userInfo');
        Route::get('support/users', 'users');
        Route::get('support/users/{mode}', 'users');
        //token
        Route::get('support/token/refresh', 'refresh');
    });
});
