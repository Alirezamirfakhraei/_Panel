<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->resource('roles', 'RoleController', ['except' => 'show']);
    $router->get('roles', 'RoleController@index')->name('roles.index');
});
