<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Tweet::factory()
            ->count(50)
            ->create();
    }
}
