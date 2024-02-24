<?php

namespace App\Repositories\User\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use RuntimeException;

class FailedFollowException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 500;
    }

    public function getResponseJson(): array
    {
        return ['message' => 'フォローに失敗しました。'];
    }
}
