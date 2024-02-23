<?php

namespace App\Repositories\Notification\Interface;

use Illuminate\Support\Collection;

interface NotificationRepositoryInterface
{
    /**
     *
     * @return Collection
     */

    public function getNotifications(): Collection;
}
