<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Models\User;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;

class TweetActionController extends Controller
{

    private TweetRepositoryInterface $tweetActionRepo;

    public function __construct(
        TweetRepositoryInterface $tweetActionRepo,
    ) {
        $this->tweetActionRepo  = $tweetActionRepo;
    }

    public function toggleActionTweet(Tweet $tweet, User $user)
    {
        $this->tweetActionRepo->toggleActionTweet($tweet, $user);

        return response()->json(['message' => 'action tweet successful']);
    }
}
