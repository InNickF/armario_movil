<?php

use Faker\Factory as Faker;
use App\Models\PostComment;
use App\Repositories\PostCommentRepository;

trait MakePostCommentTrait
{
    /**
     * Create fake instance of PostComment and save it in database
     *
     * @param array $postCommentFields
     * @return PostComment
     */
    public function makePostComment($postCommentFields = [])
    {
        /** @var PostCommentRepository $postCommentRepo */
        $postCommentRepo = App::make(PostCommentRepository::class);
        $theme = $this->fakePostCommentData($postCommentFields);
        return $postCommentRepo->create($theme);
    }

    /**
     * Get fake instance of PostComment
     *
     * @param array $postCommentFields
     * @return PostComment
     */
    public function fakePostComment($postCommentFields = [])
    {
        return new PostComment($this->fakePostCommentData($postCommentFields));
    }

    /**
     * Get fake data of PostComment
     *
     * @param array $postFields
     * @return array
     */
    public function fakePostCommentData($postCommentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'post_id' => $fake->randomDigitNotNull,
            'user_id' => $fake->randomDigitNotNull,
            'body' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $postCommentFields);
    }
}
