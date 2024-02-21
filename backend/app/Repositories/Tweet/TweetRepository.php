<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Repositories\Tweet\Exceptions\FailedGetTweetsException;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;

class TweetRepository implements TweetRepositoryInterface
{
    /**
     * @throws FailedGetTweetsException
     *
     * @return Tweet
     */
    public function getTweets()
    {
        $tweets = Tweet::get();

        if (!$tweets) {
            throw new FailedGetTweetsException();
        }

        return $tweets;
    }
}
