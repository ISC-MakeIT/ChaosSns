<?php

namespace App\Repositories\S3\Interface;

use Illuminate\Http\UploadedFile;

interface S3RepositoryInterface
{
    public function upload(UploadedFile $file): string;
}
