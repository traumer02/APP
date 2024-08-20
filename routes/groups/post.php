<?php

use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
    Route::get('/', [PostController::class, 'index']);
});

Route::prefix('comments')->middleware('auth:api')->group(function () {
    Route::post('/', [CommentController::class, 'store']);
    Route::delete('/{id}', [CommentController::class, 'destroy']);
});
