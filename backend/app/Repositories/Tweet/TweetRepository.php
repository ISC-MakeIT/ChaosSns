<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Repositories\Tweet\Exceptions\FailedGetTweetException;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;

class TweetRepository implements TweetRepositoryInterface
{
    /**
     * @throws FailedGetTweetException
     *
     * @return Tweet
     */
    public function getTweets()
    {
        $tweets = Tweet::get();

        if (!$tweets) {
            throw new FailedGetTweetException();
        }

        return $tweets;
    }
}
