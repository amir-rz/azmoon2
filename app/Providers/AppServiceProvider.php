<?php

namespace App\Providers;

use App\Repositories\Contracts\AnswerSheetRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\QuestionRepositoryInterface;
use App\Repositories\Contracts\QuizzRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\EloquentAnswerSheetRepository as EloquentEloquentAnswerSheetRepository;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentQuestionRepository;
use App\Repositories\Eloquent\EloquentQuizzRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Json\JsonUserRepository;
use EloquentAnswerSheetRepository;
use Illuminate\Support\Facades\App;
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
    }
    
    public function boot()
    {
         $this->app->bind(UserRepositoryInterface::class,EloquentUserRepository::class);
         $this->app->bind(CategoryRepositoryInterface::class,EloquentCategoryRepository::class);
         $this->app->bind(QuizzRepositoryInterface::class,EloquentQuizzRepository::class);
        $this->app->bind(QuizzRepositoryInterface::class,EloquentQuizzRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class,EloquentQuestionRepository::class);
        $this->app->bind(AnswerSheetRepositoryInterface::class,EloquentEloquentAnswerSheetRepository::class);


    }
}
