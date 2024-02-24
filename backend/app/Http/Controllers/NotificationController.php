<?php

namespace App\Http\Controllers;

use App\Repositories\Notification\Interface\NotificationRepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

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

        return [
            'message' => 'get notifications successful',
            'notifications' => $notifications
        ];
    }
}
