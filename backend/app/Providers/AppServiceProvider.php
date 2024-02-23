<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Tweet\Interface\TweetRepositoryInterface::class,
            \App\Repositories\Tweet\TweetRepository::class
        );
        $this->app->bind(
            \App\Repositories\Notification\Interface\NotificationRepositoryInterface::class,
            \App\Repositories\Notification\NotificationRepository::class
        );
        $this->app->bind(
            \App\Repositories\User\Interface\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
