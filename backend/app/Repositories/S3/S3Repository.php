<?php

namespace App\Repositories\S3;

use App\Repositories\S3\Interface\S3RepositoryInterface;
use Illuminate\Http\UploadedFile;

class S3Repository implements S3RepositoryInterface
{
    public function upload(UploadedFile $file): string
    {
        return 'https://temp.files.com';
    }
}
