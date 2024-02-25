<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\NotificationType;
use App\Repositories\Notification\Interface\NotificationRepositoryInterface;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\User\Exceptions\FailedFindUserException;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepo;

    private S3RepositoryInterface $s3Repo;

    private NotificationRepositoryInterface $notificationRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        S3RepositoryInterface $s3Repo,
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->userRepo         = $userRepo;
        $this->s3Repo           = $s3Repo;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return JsonResponse
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        return DB::transaction(function() use ($request) {
            $icon    = new File($request->file('icon')->getPathname());
            $iconURL = $this->s3Repo->upload($icon);

            $this->userRepo->create(
                $request->validated('email'),
                $request->validated('description'),
                $request->validated('password'),
                $request->validated('name'),
                $iconURL,
            );

            return response()->json(['message' => 'create user successful']);
        });
    }

    /**
     * @param UpdateUserRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user              = $this->userRepo->getLoggedInUser();
        $user->name        = $request->validated('name');
        $user->description = $request->validated('description');

        $updatedUser = $this->userRepo->update($user);

        return response()->json([
            'message' => 'update user successful',
            'user'    => $updatedUser->toArrayForLoggedInUser()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function follow(Request $request, $id): JsonResponse
    {
        $loggedInUser = $this->userRepo->getLoggedInUser();
        $targetUser   = $this->userRepo->findOneById(intval($id));

        $actionSuccessful = $this->userRepo->toggleFollow($loggedInUser, $targetUser);
        if ($actionSuccessful) {
            $this->notificationRepo->create(
                $loggedInUser,
                $targetUser,
                NotificationType::FOLLOWED,
                sprintf("%sはあなたを%sしました。", $loggedInUser->name, NotificationType::FOLLOWED->toJa())
            );
        }

        return response()->json([
            'message' => 'follow user successful'
        ]);
    }

    public function find(Request $request, $id)
    {
        $user = $this->userRepo->findOneById(intval($id));

        if(!$user){
            return response()->json(['message' => 'user not found'], 404);
        }

        $isFollowing = false;
        try {
            $loggedInUser = $this->userRepo->getLoggedInUser();
        } catch (FailedFindUserException $e) {
            return response()->json([
                'message'     => 'find user successful',
                'user'        => $user->toArrayForNormalUser(),
                'isFollowing' => $isFollowing,
            ]);
        }

        $isFollowing = $this->userRepo->isFollowing($loggedInUser, $user);

        return response()->json([
            'message'     => 'find user successful',
            'user'        => $user->toArrayForNormalUser(),
            'isFollowing' => $isFollowing,
        ]);
    }

    public function editUserIcon(Request $request, $id)
    {
        $user = $this->userRepo->findOneById($id);
        if(!$user){
            return response()->json(['message' => 'user not found'], 404);
        }


        $iconURL = $this->s3Repo->upload($request->file('icon'));
        $user->icon = $iconURL;
        $user->save();

        return response()->json(['message' => 'update icon successful']);

    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->userRepo->findOneByAuth(
            $request->validated('email'),
            $request->validated('password'),
        );

        $this->userRepo->login($user);

        return response()->json(['message' => 'login successful']);
    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->userRepo->logout();

        return response()->json(['message' => 'logout successful']);
    }

    /**
     * @return JsonResponse
     */
    public function getLoggedInUser(): JsonResponse
    {
        $user = $this->userRepo->getLoggedInUser();

        return response()->json([
            'message' => 'get user successful',
            'user'    => $user->toArrayForLoggedInUser()
        ]);
    }
}
