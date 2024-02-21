<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Repositories\Tweet\Exceptions\FailedGetTweetsException;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;
use Illuminate\Support\Collection;

class TweetRepository implements TweetRepositoryInterface
{
    /**
     * @throws FailedGetTweetsException
     *
     * @return Collection
     */
    public function getTweets(): Collection
    {
        $tweets = Tweet::get();

        if (!$tweets) {
            throw new FailedGetTweetsException();
        }

        return $tweets;
    }
}
