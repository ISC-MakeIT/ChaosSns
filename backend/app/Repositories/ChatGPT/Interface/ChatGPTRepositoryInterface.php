<?php

namespace App\Repositories\ChatGPT\Interface;

use Illuminate\Http\File;

interface ChatGPTRepositoryInterface
{
    public function createImage(string $prompt): File;
}
