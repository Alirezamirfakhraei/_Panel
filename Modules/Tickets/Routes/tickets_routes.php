<?php

use Illuminate\Support\Facades\Route;
use Mlk\Tickets\Http\Controllers\TicketsController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->controller(TicketsController::class)->group(function ($router) {
        $router->get('current-tickets', ['uses' => 'TicketsController@index', 'as' => 'tickets.index']);
        $router->get('all-tickets','TicketsController@showAllTicket')->name('all.tickets');
        $router->patch('tickets/{id}/status','TicketsController@changeStatus')->name('tickets.change.status');
    });
});