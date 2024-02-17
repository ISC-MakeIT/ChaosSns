<?php

namespace App\Models;

enum TweetKind: string
{
    case BAD   = 'bad';
    case LIKE  = 'like';
    case SMELL = 'smell';

    public function toString(): string
    {
        return $this->value;
    }

    public function toJa(): string
    {
        return match ($this) {
            TweetKind::BAD   => 'バッド',
            TweetKind::LIKE  => 'いいね',
            TweetKind::SMELL => 'くさいいね',
        };
    }
}
