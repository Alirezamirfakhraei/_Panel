<?php

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Mlk\User\Http\Controllers\Main\UserController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    Route::controller(UserController::class)->group(function () {
        Route::get('users/add/{userId}/role', 'addRole')->name('users.add.role');
        Route::post('users/add/{userId}/role', 'addRoleStore')->name('users.add.role.store');
        Route::delete('users/remove/{userId}/role/{roleId}', 'removeRole')->name('users.remove.role');
        Route::resource('users', 'UserController', ['except' => 'show']);
    });
});

Route::group(['namespace' => 'Main', 'middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    //register user
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users/create', 'UserController@store')->name('users.store');
    //all users
    Route::get('users', 'UserController@index')->name('users.index');
    //edit user
    Route::get('users/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::match(['put', 'patch'], 'users/edit/{id}', 'UserController@update')->name('users.update');
    //delete user
    Route::delete('users/remove/{id}', 'UserController@destroy')->name('users.destroy');


    $router->get('send/email', static function () {
        dispatch(new Mlk\User\Jobs\SendEmailToUserJob('milwad@gmail.com'));

        return 'send';
    });
    $router->get('send/notifications', static function () {
        Notification::send(auth()->user(), new Mlk\User\Notifications\SendEmailToUserNotification);
        return 'notif';
    });
    $router->get('mark/notifications', static function () {
        auth()->user()->unreadNotifications->markAsRead();
        \Mlk\Share\Repositories\ShareRepo::successMessage(title: 'پیام ها با موفقیت خوانده شد');
        return back();
    })->name('mark.notifications');
    $router->get('fire/event', static function () {
        event(new Mlk\User\Events\SendEmailToUserEvent('milwad@gmail.com'));

        return 'event fired';
    });

});
