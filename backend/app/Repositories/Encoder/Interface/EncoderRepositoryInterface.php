<?php

namespace App\Repositories\Encoder\Interface;

use Illuminate\Http\File;

interface EncoderRepositoryInterface
{
    public function videoToFuckingShitQuality(File $file): File;
}
