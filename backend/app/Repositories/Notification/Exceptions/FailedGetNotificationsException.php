<?php

namespace App\Repositories\Notification\Exceptions;

use App\Exceptions\HttpExceptionInterface;
use RuntimeException;

class FailedGetNotificationsException extends RuntimeException implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 500;
    }

    public function getResponseJson(): array
    {
        return ['message' => '通知を取得できませんでした。'];
    }
}
