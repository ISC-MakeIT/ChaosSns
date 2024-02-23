<?php

namespace App\Repositories\Tweet\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use RuntimeException;

class FailedGetTweetsException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 500;
    }

    public function getResponseJson(): array
    {
        return ['message' => 'ツイートを取得できませんでした。'];
    }
}
