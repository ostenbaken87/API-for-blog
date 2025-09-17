<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Post Routes
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);//- все посты текущего пользователя
        Route::get('/published', [PostController::class, 'published']);//- только опубликованные посты
        Route::post('/', [PostController::class, 'store']);//- создание нового поста
        Route::get('/{post}', [PostController::class, 'show']);//- просмотр конкретного поста
        Route::patch('/{post}', [PostController::class, 'update']);//- обновление поста
        Route::delete('/{post}', [PostController::class, 'destroy']);//- удаление поста
        Route::post('/{post}/publish', [PostController::class, 'publish']);//- опубликовать пост
        Route::post('/{post}/archive', [PostController::class, 'archive']);//- архивировать пост
    });

    // Comment Routes
    Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('/user/{userId}/active-posts', [CommentController::class, 'userCommentsOnActivePosts']);
    Route::get('/post/{postId}', [CommentController::class, 'postComments']);
    Route::get('/{commentId}/replies', [CommentController::class, 'commentReplies']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{comment}', [CommentController::class, 'show']);
    Route::put('/{comment}', [CommentController::class, 'update']);
    Route::patch('/{comment}', [CommentController::class, 'update']);
    Route::delete('/{comment}', [CommentController::class, 'destroy']);
});

    // Info user and logout
    Route::get('/user', [AuthController::class, 'user']);//- информация о текущем пользователе
    Route::post('/logout', [AuthController::class, 'logout']);
});
