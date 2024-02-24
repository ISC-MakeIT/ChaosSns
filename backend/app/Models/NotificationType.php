<?php

namespace App\Models;

enum NotificationType: string
{
    case ACTIONED = 'actioned';
    case REPLIED  = 'replied';
    case FOLLOWED = 'followed';

    public function toString(): string
    {
        return $this->value;
    }

    public function toJa(): string
    {
        return match ($this) {
            NotificationType::ACTIONED => 'バッドボタン',
            NotificationType::REPLIED  => 'リプライ',
            NotificationType::FOLLOWED => 'フォロー',
        };
    }
}
