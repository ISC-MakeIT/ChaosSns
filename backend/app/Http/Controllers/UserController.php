<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginRequest;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $iconURL = $this->s3Repo->upload($request->file('icon'));

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
        // $this->userRepo->findOneByAuth(
        //     $request->validated('email'),
        //     $request->validated('password'),
        // );
        //
        // return response()->json(['message' => 'login successful']);

        // FIXME: 上記の場合だとuserが取得できなかったので実装を変えている
        // DDDに合うように変更を頼みたい
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // return redirect()->intended('dashboard');

            return response()->json(['message' => 'login successful']);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {

        // $this->userRepo->logout();

        // FIXME: 上記の場合だとuserが取得できなかったので実装を変えている
        // DDDに合うように変更を頼みたい
        $request->session()->invalidate();
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
