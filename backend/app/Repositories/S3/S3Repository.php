<?php

namespace App\Repositories\S3;

use App\Repositories\S3\Interface\S3RepositoryInterface;
use Aws\S3\S3Client;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class S3Repository implements S3RepositoryInterface
{
    private S3Client $client;

    public function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    public function upload(File $file): string
    {
        $result = $this->client->upload(
            config('services.s3.bucket'),
            sprintf("image/icons/%s.%s", Str::uuid(), $file->extension()),
            $file->getContent(),
            'public-read'
        );

        return $result['ObjectURL'];
    }
}
