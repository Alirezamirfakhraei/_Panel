<?php

use Illuminate\Support\Facades\Route;
use Mlk\Tickets\Repositories\TicketsController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(TicketsController::class)->group(function ($router) {
        $router->get('tickets', ['uses' => 'TicketsController@index', 'as' => 'tickets.index']);
    });
});