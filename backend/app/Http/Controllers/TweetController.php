<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tweet\CreateTweetRequest;
use App\Models\SpamUser;
use App\Models\TweetKind;
use App\Repositories\Encoder\Interface\EncoderRepositoryInterface;
use App\Repositories\S3\Interface\S3RepositoryInterface;
use App\Models\Tweet;
use App\Models\TweetFileType;
use App\Repositories\Tweet\Interface\TweetRepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\File;

class TweetController extends Controller
{
    use WithFaker;

    private TweetRepositoryInterface $tweetRepo;
    private UserRepositoryInterface $userRepo;

    private S3RepositoryInterface $s3Repo;
    private EncoderRepositoryInterface $encoderRepo;

    public function __construct(
        TweetRepositoryInterface $tweetRepo,
        UserRepositoryInterface $userRepo,
        S3RepositoryInterface $s3Repo,
        EncoderRepositoryInterface $encoderRepo
    ) {
        $this->tweetRepo   = $tweetRepo;
        $this->userRepo    = $userRepo;
        $this->s3Repo      = $s3Repo;
        $this->encoderRepo = $encoderRepo;
    }

    public function getTweets()
    {
        $tweets = $this->tweetRepo->getTweets();

        return $tweets;
    }

    public function create(CreateTweetRequest $request)
    {
        $user = $this->userRepo->getLoggedInUser();

        /** @var File */
        $outputtedFile    = null;

        /** @var string */
        $outputtedFileURL = null;

        /** @var TweetFileType */
        $tweetFileType = TweetFileType::EMPTY;

        if ($request->has('video')) {
            $outputtedFile = $this->encoderRepo->videoToFuckingShitQuality(
                new File($request->file('video')->getPathname())
            );
            $tweetFileType = TweetFileType::VIDEO;
        }
        if ($request->has('image')) {
            // TODO: image to gaming image :D
            $outputtedFile = new File($request->file('image')->getPathname());
            $tweetFileType = TweetFileType::IMAGE;
        }

        if ($outputtedFile) {
            $outputtedFileURL = $this->s3Repo->upload($outputtedFile);
        }

        $SPAM_REPLY_COUNT = 10;

        $tweet = $this->tweetRepo->create(
            $user->id,
            $request->validated('content'),
            TweetKind::BAD,
            $outputtedFileURL,
            $tweetFileType,
            $request->validated('reply_to')
        );

        // FIXME: エラーが起きてしまうのでいったん無効化
        for ($i = 0; $i < $SPAM_REPLY_COUNT; $i++) {
            // $this->tweetRepo->create(
            //     SpamUser::inRandomOrder()->first()->user_id,
            //     $this->faker('ar_SA')->word(),
            //     TweetKind::BAD,
            //     $outputtedFileURL
            // );
        }

        return $tweet;
    }
    public function deleteTweet($id)
    {
        $this->tweetRepo->deleteTweet($id);

        return response()->json(['message' => 'delete tweet successful']);
    }
}
