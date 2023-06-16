<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

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
Route::group(['prefix' => 'admin'], function () {
    Route::controller(AuthController::class)->group(function () {
        //view login and register admin
        Route::get('login', 'login');
        Route::get('register', 'register');
        //login and register method
        Route::post('/authenticate', 'authenticate')->name('admin.authenticate');
        Route::post('/store', 'store')->name('admin.store');
    });
});
