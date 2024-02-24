<?php

namespace App\Http\Requests\Tweet;

use App\Http\Requests\BaseRequest;

class CreateTweetRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'max:256'],
            'image'   => ['image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'video'   => ['mimes:mp4', 'max:20000'],
        ];
    }
}
