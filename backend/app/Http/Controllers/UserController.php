<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginRequest;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepo;

    private S3RepositoryInterface $s3Repo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        S3RepositoryInterface $s3Repo
    ) {
        $this->userRepo = $userRepo;
        $this->s3Repo = $s3Repo;
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
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $this->userRepo->findOneByAuth(
            $request->validated('email'),
            $request->validated('password'),
        );

        return response()->json(['message' => 'login successful']);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
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
