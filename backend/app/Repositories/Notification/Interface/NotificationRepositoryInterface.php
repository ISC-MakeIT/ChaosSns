<?php

namespace App\Repositories\Notification\Interface;

use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Collection;

interface NotificationRepositoryInterface
{
    /**
     *
     * @return Collection
     */

    public function getNotificationsByUser(User $user): Collection;

    public function create(User $logggedInUser, User $targetUser, NotificationType $notificationType, string $content): Notification;

    public function readNotificationsByUser(User $user): void;

    public function getNotReadNotificationsCountByUser(User $user): int;
}
