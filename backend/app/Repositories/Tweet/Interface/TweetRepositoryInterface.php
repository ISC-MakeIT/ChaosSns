<?php

namespace App\Repositories\Tweet\Interface;

use App\Models\Tweet;
use App\Models\TweetFileType;
use App\Models\TweetKind;
use App\Models\User;
use Illuminate\Support\Collection;

interface TweetRepositoryInterface
{
    public function findOneById(int $tweetId): Tweet;

    /**
     * すべてのユーザーのツイート取得
     *
     * @return Collection
     */
    public function getTweets(): Collection;

    public function create(
        int $owner,
        string $content,
        TweetKind $tweetKind,
        ?string $file = null,
        ?TweetFileType $tweetFileType = TweetFileType::EMPTY,
        ?int $replyTo = null,
    ): Tweet;

    /**
     * 特定のツイート削除
     *
     * @return Collection
     */
    public function deleteTweet($id);

    public function toggleActionTweet(Tweet $tweet, User $user): bool;
}
