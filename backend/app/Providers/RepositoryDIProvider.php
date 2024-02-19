<?php

namespace App\Providers;

use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\S3\S3Repository;
use App\Repositories\User\Interface\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Aws\S3\S3Client;
use Illuminate\Support\ServiceProvider;

class RepositoryDIProvider extends ServiceProvider
{
    public function register(): void
    {
        $repositories = [
            UserRepositoryInterface::class => function() {
                return new UserRepository();
            },
            S3RepositoryInterface::class => function() {
                return new S3Repository(new S3Client([
                    'region'      => config('services.s3.region'),
                    'version'     => '2006-03-01',
                    'credentials' => [
                        'key'    => config('services.s3.key'),
                        'secret' => config('services.s3.secret'),
                    ],
                ]));
            },
        ];

        foreach ($repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    public function boot(): void
    {
    }
}
