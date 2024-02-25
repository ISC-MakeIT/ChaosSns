<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class TweetFactory extends Factory
{
    public function definition()
    {
        // ダミーデータの作成
        $content = fake()->text(256);

        $user_id = optional(User::inRandomOrder()->first())->id;

        return [
            'user_id' => $user_id,
            'content'  => $content,
            'file'    => 'https://temp.files.com',
            'reply_to' => null,
        ];
    }
}
