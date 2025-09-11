<?php

namespace App\Providers;

use App\Services\Post\PostService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Post\PostRepository;
use App\Services\Post\PostServiceInterface;
use App\Repositories\Post\PostRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Репозитории
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        
        // Сервисы
        $this->app->bind(PostServiceInterface::class, PostService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
