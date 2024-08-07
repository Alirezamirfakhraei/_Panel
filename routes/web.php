<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\User\Http\Controllers\UserSecondDbController;


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
Route::group(['middleware' => 'web'], function ($router) {
    $router->controller(LoginController::class)->group(function ($router) {
        $router->get('', 'view');
    });


});


Route::group(['middleware' => 'web'], function ($router) {
    Route::get('admin/users/inactive', [UserSecondDbController::class, 'getUsersInactive'])->name('users.inactive');
});
