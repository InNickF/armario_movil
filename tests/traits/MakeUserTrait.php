<?php

use Faker\Factory as Faker;
use App\User;
use App\Repositories\UserRepository;

trait MakeUserTrait
{
    /**
     * Create fake instance of User and save it in database
     *
     * @param array $userFields
     * @return User
     */
    public function makeUser($userFields = [])
    {
        /** @var UserRepository $userRepo */
        $userRepo = App::make(UserRepository::class);
        $theme = $this->fakeUserData($userFields);
        return $userRepo->create($theme);
    }

    /**
     * Get fake instance of User
     *
     * @param array $userFields
     * @return User
     */
    public function fakeUser($userFields = [])
    {
        return new User($this->fakeUserData($userFields));
    }

    /**
     * Get fake data of User
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserData($userFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'avatar_image' => $fake->word,
            'name' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'phone' => $fake->word,
            'address' => $fake->word,
            'description' => $fake->text,
            'facebook_url' => $fake->word,
            'instagram_url' => $fake->word,
            'twitter_url' => $fake->word,
            'youtube_url' => $fake->word,
            'website' => $fake->word,
            'language' => $fake->word,
            'store_id' => $fake->randomDigitNotNull,
            'email_verified_at' => $fake->date('Y-m-d H:i:s'),
            'remember_token' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $userFields);
    }
}
