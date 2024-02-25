<?php

namespace App\Http\Controllers;

use App\Repositories\Notification\Interface\NotificationRepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;

class NotificationController extends Controller
{
    private NotificationRepositoryInterface $notificationRepo;
    private UserRepositoryInterface $userRepo;

    public function __construct(
        NotificationRepositoryInterface $notificationRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->notificationRepo = $notificationRepo;
        $this->userRepo         = $userRepo;
    }

    public function getNotifications()
    {
        $loggedInUser  = $this->userRepo->getLoggedInUser();
        $notifications = $this->notificationRepo->getNotificationsByUser($loggedInUser);

        return response()->json([
            'message' => 'get notifications successful',
            'notifications' => $notifications
        ]);
    }

    public function getNotReadNotificationsCount()
    {
        $loggedInUser = $this->userRepo->getLoggedInUser();
        $count        = $this->notificationRepo->getNotReadNotificationsCountByUser($loggedInUser);

        return response()->json([
            'message' => 'get not read notifications count successful',
            'count'   => $count
        ]);
    }

    public function readAllNotifications()
    {
        $loggedInUser = $this->userRepo->getLoggedInUser();
        $this->notificationRepo->readNotificationsByUser($loggedInUser);

        return response()->json([
            'message' => 'read notifications successful'
        ]);
    }
}
