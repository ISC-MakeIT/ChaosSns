<?php

namespace App\Http\Controllers;

use App\Repositories\Notification\Interface\NotificationRepositoryInterface;

class NotificationController extends Controller
{
    private NotificationRepositoryInterface $notificationRepo;

    public function __construct(
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->notificationRepo = $notificationRepo;
    }

    public function getNotifications()
    {
        $notifications = $this->notificationRepo->getNotifications();

        return $notifications;
    }
}
