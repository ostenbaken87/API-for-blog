<?php

namespace App\Providers;

use App\Services\Post\PostService;
use Illuminate\Support\ServiceProvider;
use App\Services\Comment\CommentService;
use App\Repositories\Post\PostRepository;
use App\Services\Post\PostServiceInterface;
use App\Repositories\Comment\CommentRepository;
use App\Services\Comment\CommentServiceInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Репозитории
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        
        // Сервисы
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
