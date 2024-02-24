<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\User;
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
    public function getNotificationsByUser(User $user): Collection
    {
        $notifications = Notification::where('to', $user->id)->get();

        if (!$notifications) {
            throw new FailedGetNotificationsException();
        }

        return $notifications;
    }

    public function getNotReadNotificationsCountByUser(User $user): int
    {
        return Notification::where('to', $user->id)->count();
    }

    public function create(User $logggedInUser, User $targetUser, NotificationType $notificationType, string $content): Notification
    {
        return Notification::create([
            'from'    => $logggedInUser->id,
            'to'      => $targetUser->id,
            'type'    => $notificationType->toString(),
            'content' => $content
        ]);
    }

    public function readNotificationsByUser(User $user): void
    {
        Notification::where('to', $user->id)
            ->where('is_read', true)
            ->update(['is_read' => true]);
    }
}
