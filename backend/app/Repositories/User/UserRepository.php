<?php

namespace App\Repositories\User;

use App\Models\FollowedUser;
use App\Models\User;
use App\Repositories\User\Exceptions\FailedCreateUserException;
use App\Repositories\User\Exceptions\FailedFindUserException;
use App\Repositories\User\Exceptions\FailedFollowException;
use App\Repositories\User\Exceptions\FailedLoginException;
use App\Repositories\User\Exceptions\FailedLogoutException;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @throws FailedCreateUserException
     *
     * @return User
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
            logs()->error($e);
            throw new FailedCreateUserException();
        }
    }

    public function update(User $user): User
    {
        $user->save();

        return $user;
    }

    public function toggleFollow(User $loggedInUser, User $target): bool
    {
        try {
            $followedUser = FollowedUser::where('owner', $loggedInUser->id)
                ->where('target', $target->id)
                ->first();

            if (!$followedUser) {
                FollowedUser::create([
                    'owner'  => $loggedInUser->id,
                    'target' => $target->id
                ]);
                return true;
            }

            $followedUser->delete();
            return false;
        } catch (Throwable $e) {
            logs()->error($e);
            throw new FailedFollowException();
        }
    }

    public function findOneById(int $id): User
    {
        $user = User::with('tweets')->where('id', $id)->first();

        if (!$user) {
            throw new FailedFindUserException();
        }

        return $user;
    }


    public function editUserIcon(int $id, string $iconURL): User
    {
        $user = User::find($id);

        if (!$user) {
            throw new FailedFindUserException();
        }

        $user->icon = $iconURL;
        $user->save();

        return $user;
    }



    /**
     * @throws FailedLoginException
     *
     * @return User
     */
    public function findOneByAuth(string $email, string $password): User
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new FailedFindUserException();
        }

        if (!Hash::check($password, $user->password)) {
            throw new FailedFindUserException();
        }

        return $user;
    }

    public function getLoggedInUser(): User
    {
        $user = User::with('tweets')->where('id', auth()->id())->first();;

        if (!$user) {
            throw new FailedFindUserException();
        }

        return $user;
    }

    public function isFollowing(User $loggedInUser, User $target): bool
    {
        $followedUser = FollowedUser::where('owner', $loggedInUser->id)
            ->where('target', $target->id)
            ->first();

        return $followedUser !== null;
    }

    public function login(User $user): void
    {
        try {
            auth()->login($user);
            session()->regenerate();
        } catch (Throwable $e) {
            throw new FailedLoginException();
        }
    }

    public function logout(): void
    {
        try {
            session()->flush();
        } catch (Throwable $e) {
            throw new FailedLogoutException();
        }
    }
}
