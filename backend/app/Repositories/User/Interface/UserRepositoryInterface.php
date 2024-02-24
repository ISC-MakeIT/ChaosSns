<?php

namespace App\Repositories\User\Interface;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(string $email, string $description, string $password, string $name, string $iconURL): User;

    public function find(int $id): User;


    public function findOneByAuth(string $email, string $password): User;

    public function getLoggedInUser(): User;

    public function login(User $user): void;

    public function logout(): void;
}
