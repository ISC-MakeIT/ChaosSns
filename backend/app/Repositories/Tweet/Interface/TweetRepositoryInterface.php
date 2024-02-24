<?php

namespace App\Repositories\Tweet\Interface;

use App\Models\Tweet;
use App\Models\TweetKind;
use Illuminate\Support\Collection;

interface TweetRepositoryInterface
{
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
        ?int $replyTo = null,
    ): Tweet;

    /**
     * 特定のツイート削除
     *
     * @return Collection
     */
    public function deleteTweet($id);
}
