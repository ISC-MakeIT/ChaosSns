<?php

namespace App\Http\Controllers;

use App\Repositories\Tweet\Interface\TweetRepositoryInterface;

class TweetController extends Controller
{
    private TweetRepositoryInterface $tweetRepo;

    public function __construct(
        TweetRepositoryInterface $tweetRepo
    ) {
        $this->tweetRepo = $tweetRepo;
    }

    public function getTweet()
    {
        $tweet = $this->tweetRepo->getTweet();

        return $tweet;
    }
}
