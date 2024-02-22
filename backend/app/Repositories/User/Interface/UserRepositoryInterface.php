<?php

namespace App\Repositories\User\Interface;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(string $email, string $description, string $password, string $name, string $iconURL): User;

    public function find(int $id): ?User;
    
}

 class UserRepository implements UserRepositoryInterface
 {


    public function find(int $id): ?User
    {
        return User::find($id);
    }

}
