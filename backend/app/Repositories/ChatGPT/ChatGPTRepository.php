<?php

namespace App\Repositories\ChatGPT;

use App\Repositories\ChatGPT\Interface\ChatGPTRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class ChatGPTRepository implements ChatGPTRepositoryInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createImage(string $prompt): File
    {
        $response = $this->client->request(
            'POST',
            'https://api.openai.com/v1/images/generations',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('chatgpt.token'),
                ],
                'json'    => [
                    'model'  => 'dall-e-3',
                    'prompt' => 'prompt',
                    'n'      => 1,
                    'size'   => '1024x1024',
                ]
            ]
        );

        return new File();
    }
}
