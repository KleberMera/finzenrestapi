<?php

namespace App\Providers;

use App\Interfaces\CategoriesRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\CategoriesRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
