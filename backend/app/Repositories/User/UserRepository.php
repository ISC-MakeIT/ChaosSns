<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Exceptions\FailedCreateUserException;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Throwable;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @throws FailedCreateUserException
     */
    public function create(string $email, string $description, string $password, string $name, string $iconURL): User
    {
        try {
            return User::create([
                'name'        => $name,
                'email'       => $email,
                'description' => $description,
                'password'    => bcrypt($password),
                'icon'        => $iconURL,
            ]);
        } catch (Throwable $e) {
            throw new FailedCreateUserException();
        }
    }
}
