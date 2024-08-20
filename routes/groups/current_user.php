<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as'=>'user.'], function () {
//    Route::middleware('auth:sanctum')->post('/avatar', [UserController::class, 'avatar'])->name('avatar');

    Route::post('/register',RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
    Route::controller(UserController::class)->middleware('auth:sanctum')->group(function () {
        Route::get('/', 'user')->name('current');
        Route::post('/avatar', 'avatar')->name('avatar');
        Route::patch('/update', 'update')->name('update');
    });
});

