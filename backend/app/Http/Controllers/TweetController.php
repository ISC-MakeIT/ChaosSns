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

    public function getTweets()
    {
        $tweets = $this->tweetRepo->getTweets();

        return $tweets;
    }
}
