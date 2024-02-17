<?php

namespace Tests\Feature\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Mockery;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testユーザー作成を行うこと(): void
    {
        $icon    = UploadedFile::fake()->image('dummy.jpg', 800, 800);
        $request = new CreateUserRequest([
            'name'        => 'テスト',
            'email'       => 'example@chaossns.makeit.com',
            'password'    => 'test1234!',
            'description' => 'テストです。',
            'icon'        => $icon,
        ]);

        $user              = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->password    = bcrypt($request->password);
        $user->description = $request->description;
        $user->icon        = 'https://temp.files.com';

        $userRepoMock = Mockery::mock(UserRepositoryInterface::class)->makePartial();
        $userRepoMock->shouldReceive('create')
            ->once()
            ->andReturn($user);

        $s3RepoMock = Mockery::mock(S3RepositoryInterface::class)->makePartial();
        $s3RepoMock->shouldReceive('upload')
            ->once()
            ->andReturn($user->icon);

        $this->instance(UserRepositoryInterface::class, $userRepoMock);
        $this->instance(S3RepositoryInterface::class, $s3RepoMock);

        $response = $this->post(route('users.registration'), $request->toArray());
        $response->assertOk();
        $response->assertJson(['message' => 'create user successful']);
    }
}
