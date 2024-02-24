<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Models\TweetAction;
use App\Models\TweetKind;
use App\Models\User;
use App\Repositories\Tweet\Exceptions\FailedDeleteTweetException;
use App\Repositories\Tweet\Exceptions\FailedGetTweetException;
use App\Repositories\Tweet\Exceptions\FailedGetTweetsException;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;
use Illuminate\Support\Collection;

class TweetRepository implements TweetRepositoryInterface
{
    public function findOneById(int $tweetId): Tweet
    {
        $tweet = Tweet::with('user')->find($tweetId);

        if (!$tweet) {
            throw new FailedGetTweetException();
        }

        return $tweet;
    }

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
    ): Tweet {
        return Tweet::create([
            'user_id'  => $owner,
            'content'  => $content,
            'type'     => $tweetKind->toString(),
            'file'     => $file,
            'reply_to' => $replyTo
        ]);
    }
    /**
     * @throws FailedDeleteTweetException
     *
     * @return Collection
     */

    public function deleteTweet($id)
    {
        $tweet = Tweet::find($id);

        if (!$tweet) {
            throw new FailedDeleteTweetException();
        }

        $tweet->delete();


        return $tweet;
    }

    public function toggleActionTweet(Tweet $tweet, User $user): bool
    {
        $tweetAction = TweetAction::where("user_id", $user->id)->where('tweet_id', $tweet->id)->first();
        if ($tweetAction) {
            $tweetAction->delete();
            return false;
        }
        TweetAction::create([
            'user_id'  => $user->id,
            'tweet_id' => $tweet->id,
        ]);
        return true;
    }
}
