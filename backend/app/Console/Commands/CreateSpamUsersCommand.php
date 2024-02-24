<?php

namespace App\Console\Commands;

use App\Models\SpamUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class CreateSpamUsersCommand extends Command
{
    use WithFaker;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-spam-users-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create spam users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $faker = $this->faker('ar_SA');

        $SPAM_USER_COUNT = 5;

        for ($i = 0; $i < $SPAM_USER_COUNT; $i++) {
            User::create([
                'name'        => $faker->word(),
                'email'       => Str::random().'@spam.com',
                'password'    => bcrypt(Str::random()),
                'description' => $faker->words(5),
                'icon'        =>
            ]);
            SpamUser::create([
                'user_id' =>
            ]);
        }
    }
}
