<?php

namespace App\Repositories\Tweet\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use RuntimeException;

class FailedGetTweetException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 404;
    }

    public function getResponseJson(): array
    {
        return ['message' => 'ツイートを取得できませんでした。'];
    }
}
