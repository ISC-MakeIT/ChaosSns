<?php

namespace App\Providers;

use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\S3\S3Repository;
use App\Repositories\User\Interface\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryDIProvider extends ServiceProvider
{
    private $repositories = [
        UserRepositoryInterface::class => function() {
            return new UserRepository();
        },
        S3RepositoryInterface::class => function() {
            return new S3Repository();
        },
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    public function boot(): void
    {
    }
}
