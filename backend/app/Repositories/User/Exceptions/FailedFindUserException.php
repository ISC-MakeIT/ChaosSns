<?php

namespace App\Repositories\User\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use RuntimeException;

class FailedFindUserException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 404;
    }

    public function getResponseJson(): array
    {
        return ['message' => 'ユーザーが見つかりませんでした。'];
    }
}
