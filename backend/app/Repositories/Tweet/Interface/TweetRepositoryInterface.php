<?php

namespace App\Repositories\Tweet\Interface;

use Illuminate\Support\Collection;

interface TweetRepositoryInterface
{
    /**
     * すべてのユーザーのツイート取得
     *
     * @return Collection
     */
    public function findAll(): Collection;
}
