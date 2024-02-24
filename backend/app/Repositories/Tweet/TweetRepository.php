<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Models\TweetKind;
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

    public function create(
        int $owner,
        string $content,
        TweetKind $tweetKind,
        ?string $file = null,
        ?int $replyTo = null,
    ): Tweet
    {
        return Tweet::create([
            'user_id'  => $owner,
            'content'  => $content,
            'type'     => $tweetKind->toString(),
            'file'     => $file,
            'reply_to' => $replyTo
        ]);
    }
}
