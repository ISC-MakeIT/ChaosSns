<?php

namespace App\Repositories\Tweet\Interface;

use App\Models\Tweet;
use Illuminate\Support\Collection;

interface TweetRepositoryInterface
{
    /**
     * すべてのユーザーのツイート取得
     *
     * @return Collection
     */

    public function getTweet();
}
