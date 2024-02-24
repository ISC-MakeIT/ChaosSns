<?php

namespace App\Repositories\S3\Interface;

use Illuminate\Http\File;

interface S3RepositoryInterface
{
    public function upload(File $file): string;
}
