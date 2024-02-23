<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\Notification\Interface\NotificationRepositoryInterface;
use App\Repositories\Notification\Exceptions\FailedGetNotificationsException;
use Illuminate\Support\Collection;

class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * @throws FailedGetNotificationsException
     *
     * @return Collection
     */
    public function getNotifications(): Collection
    {
        $notifications = Notification::get();

        if (!$notifications) {
            throw new FailedGetNotificationsException();
        }

        return $notifications;
    }
}
