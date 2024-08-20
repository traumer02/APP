<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->middleware('auth:api')->group(function () {
    Route::get('/{identifier}', [UserController::class, 'show']);
    Route::post('/subscribe', [UserController::class, 'subscribe']);
    Route::post('/unsubscribe', [UserController::class, 'unsubscribe']);
});




