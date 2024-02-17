<?php

namespace Tests\Feature\Repositories\User;

use App\Repositories\User\Exceptions\FailedCreateUserException;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private UserRepository $userRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepo = new UserRepository();
    }

    public function testCreate(): void
    {
        $args = [
            'name'        => 'テスト',
            'email'       => 'example@chaossns.makeit.com',
            'password'    => 'test1234!',
            'description' => 'テストです。',
            'icon'        => 'httos://example.com',
        ];

        $createdUser = $this->userRepo->create(
            $args['email'],
            $args['description'],
            $args['password'],
            $args['name'],
            $args['icon'],
        );

        $this->assertSame(
            [
                $args['name'],
                $args['email'],
                $args['description'],
                $args['icon'],
            ],
            [
                $createdUser->name,
                $createdUser->email,
                $createdUser->description,
                $createdUser->icon,
            ],
            '作成確認'
        );

        $this->assertTrue(Hash::check($args['password'], $createdUser->password), '作成確認 (パスワードのみ)');

        $this->assertThrows(
            function() {
                $this->userRepo->create(
                    Str::random(300),
                    '',
                    '',
                    '',
                    '',
                );
            },
            FailedCreateUserException::class,
        );
    }
}
