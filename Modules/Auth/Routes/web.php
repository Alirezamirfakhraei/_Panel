<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\V1\SupportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1'], function ($router) {
    Route::controller(SupportController::class)->group(function () {
        //admin
        Route::get('test', 'test');
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