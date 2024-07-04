<?php

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\UserSecondDbController;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    Route::controller(UserController::class)->group(function ($router) {
        Route::get('users/add/{userId}/role', 'addRole')->name('users.add.role');
        Route::post('users/add/{userId}/role', 'addRoleStore')->name('users.add.role.store');
        Route::delete('users/remove/{userId}/role/{roleId}', 'removeRole')->name('users.remove.role');
        Route::resource('users', 'UserController', ['except' => 'show']);
    });
});

Route::group(['prefix' => 'admin'], static function ($router) {
    $router->controller(UserSecondDbController::class)->group(function ($router) {
        //register user
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users/create', 'store')->name('users.store');
        //all users
        Route::get('users', 'index')->name('users.index');
        //edit user
        Route::get('users/edit/{id}', 'edit')->name('users.edit');
//        Route::post('users/edit/{id}', 'edit')->name('users.update');
        Route::match(['put', 'patch'], 'users/edit/{id}', 'update')->name('users.update');
        //delete user
        Route::delete('users/remove/{id}', 'destroy')->name('users.destroy');
        $router->get('send/email', static function () {
            dispatch(new Modules\User\Jobs\SendEmailToUserJob('milwad@gmail.com'));
            return 'send';
        });
        $router->get('send/notifications', static function () {
            Notification::send(auth()->user(), new Modules\User\Notifications\SendEmailToUserNotification);
            return 'notif';
        });
        $router->get('mark/notifications', static function () {
            auth()->user()->unreadNotifications->markAsRead();
            \Modules\Share\Repositories\ShareRepo::successMessage(title: 'پیام ها با موفقیت خوانده شد');
            return back();
        })->name('mark.notifications');
        $router->get('fire/event', static function () {
            event(new Modules\User\Events\SendEmailToUserEvent('milwad@gmail.com'));

            return 'event fired';
        });
    });
});
