<?php

namespace App\Console\Commands;

use App\Models\SpamUser;
use App\Models\User;
use App\Repositories\ChatGPT\ChatGPTRepository;
use App\Repositories\S3\S3Repository;
use Aws\S3\S3Client;
use GuzzleHttp\Client;
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
        $chatGPTRepo = new ChatGPTRepository(new Client());
        $s3Repo      = new S3Repository(new S3Client([
            'region'      => config('services.s3.region'),
            'version'     => '2006-03-01',
            'credentials' => [
                'key'    => config('services.s3.key'),
                'secret' => config('services.s3.secret'),
            ],
        ]));

        $SPAM_USER_COUNT = 5;

        for ($i = 0; $i < $SPAM_USER_COUNT; $i++) {
            $result  = $chatGPTRepo->createImage('すごいかっこいいアラビア人');
            $iconURL = $s3Repo->upload($result);

            $user = User::create([
                'name'        => $faker->word(),
                'email'       => Str::random().'@spam.com',
                'password'    => bcrypt(Str::random()),
                'description' => implode($faker->words(5)),
                'icon'        => $iconURL
            ]);
            SpamUser::create([
                'user_id' => $user->id
            ]);
        }
    }
}
