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
        Route::post('support/admin/register', 'register');
        Route::post('support/admin/login', 'login');
        Route::post('support/admin/logout', 'logout');
        Route::post('support/admin/edit', 'edit');
        Route::get('support/user/All', 'sendUsers');
        Route::post('support/user/add', 'addUsers');
        Route::post('support/user/edit', 'editUsers');
        Route::get('support/user/profile', 'profile');
        Route::get('support/token/refresh', 'refresh');

    });
});
