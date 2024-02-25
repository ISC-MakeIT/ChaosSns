<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NotificationType;
use App\Repositories\Notification\Interface\NotificationRepositoryInterface;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class TweetActionController extends Controller
{
    private UserRepositoryInterface $userRepo;
    private TweetRepositoryInterface $tweetRepo;
    private NotificationRepositoryInterface $notificationRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        TweetRepositoryInterface $tweetRepo,
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->userRepo         = $userRepo;
        $this->tweetRepo        = $tweetRepo;
        $this->notificationRepo = $notificationRepo;
    }

    public function toggleActionTweet(Request $request, $id)
    {
        $tweet        = $this->tweetRepo->findOneById($id);
        $loggedInUser = $this->userRepo->getLoggedInUser();

        $isActionedTweet = $this->tweetRepo->toggleActionTweet($tweet, $loggedInUser);
        if ($isActionedTweet) {
            $this->notificationRepo->create(
                $loggedInUser,
                $tweet->user,
                NotificationType::ACTIONED,
                sprintf("%sはあなたを%sしました。", $loggedInUser->name, NotificationType::FOLLOWED->toJa())
            );
        }

        return response()->json(['message' => 'action tweet successful']);
    }
}
