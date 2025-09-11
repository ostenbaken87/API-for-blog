<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Post Routes
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);//- все посты текущего пользователя !Check!
        Route::get('/published', [PostController::class, 'published']);//- только опубликованные посты !Check!
        Route::post('/', [PostController::class, 'store']);//- создание нового поста !Check!
        Route::get('/{post}', [PostController::class, 'show']);//- просмотр конкретного поста
        Route::patch('/{post}', [PostController::class, 'update']);//- обновление поста !Check!
        Route::delete('/{post}', [PostController::class, 'destroy']);//- удаление поста
        Route::post('/{post}/publish', [PostController::class, 'publish']);//- опубликовать пост !Check!
        Route::post('/{post}/archive', [PostController::class, 'archive']);//- архивировать пост
    });

    // Info user and logout
    Route::get('/user', [AuthController::class, 'user']);//- информация о текущем пользователе
    Route::post('/logout', [AuthController::class, 'logout']);
});
