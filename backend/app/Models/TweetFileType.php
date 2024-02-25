<?php

namespace App\Models;

enum TweetFileType: string
{
    case EMPTY = 'empty';
    case VIDEO = 'video';
    case IMAGE = 'image';

    public function toString(): string
    {
        return $this->value;
    }
}
