<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Json\JsonUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind(CategoryRepositoryInterface::class,EloquentCategoryRepository::class);
        
    }
    
    public function boot()
    {
        return $this->app->bind(UserRepositoryInterface::class,EloquentUserRepository::class);

    }
}
