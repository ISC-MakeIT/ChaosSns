<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(string $email, string $description, string $password, string $name, string $iconURL): User
    {
        return User::create([
            'name'        => $name,
            'email'       => $email,
            'description' => $description,
            'password'    => bcrypt($password),
            'icon'        => $iconURL,
        ]);
    }
}
