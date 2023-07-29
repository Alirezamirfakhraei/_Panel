<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'admin'], static function ($router) {
    $router->get('repairs', ['uses' => 'RepairsController@index', 'as' => 'repairs.index']);
});
