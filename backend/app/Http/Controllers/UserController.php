<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use http\Client\Curl\User;
use http\Env\Response;
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

    public function create(CreateUserRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $iconURL = $this->s3Repo->upload($request->validated('icon'));

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
    public function show($id)
    {
        $user = $this->userRepo->find($id);

        if(!$user){
            return response()->json(['message' => 'user not found'], 404);
        }
        return response()->json($user);
    }


}
