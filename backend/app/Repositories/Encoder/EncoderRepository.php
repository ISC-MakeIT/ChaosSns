<?php

namespace App\Repositories\Encoder;

use App\Repositories\Encoder\Interface\EncoderRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class EncoderRepository implements EncoderRepositoryInterface
{
    public function videoToFuckingShitQuality(File $file): File
    {
        $randomString        = Str::random(16);
        $step1OutputFilename = 'step1_'.$randomString.'.mp4';
        $step2OutputFilename = 'step2_'.$randomString.'.wav';
        $outputFilename      = $randomString.'.'.$file->getExtension();

        Process::run("ffmpeg -i {$file->getPathname()} -vf scale=144:-1 /tmp/{$step1OutputFilename}");
        Process::run("ffmpeg -i {$file->getPathname()} -vn -af volume=91dB -c:a pcm_s16le /tmp/{$step2OutputFilename}");
        Process::run("ffmpeg -i {$step1OutputFilename} -i /tmp/{$step2OutputFilename} -c:v copy -c:a aac -map 0:v:0 -map 1:a:0 /tmp/{$outputFilename}");

        return new File('/tmp/'.$outputFilename);
    }
}
