<?php

use Faker\Factory as Faker;
use App\Models\Story;
use App\Repositories\StoryRepository;

trait MakeStoryTrait
{
    /**
     * Create fake instance of Story and save it in database
     *
     * @param array $storyFields
     * @return Story
     */
    public function makeStory($storyFields = [])
    {
        /** @var StoryRepository $storyRepo */
        $storyRepo = App::make(StoryRepository::class);
        $theme = $this->fakeStoryData($storyFields);
        return $storyRepo->create($theme);
    }

    /**
     * Get fake instance of Story
     *
     * @param array $storyFields
     * @return Story
     */
    public function fakeStory($storyFields = [])
    {
        return new Story($this->fakeStoryData($storyFields));
    }

    /**
     * Get fake data of Story
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStoryData($storyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'store_id' => $fake->randomDigitNotNull,
            'title' => $fake->word,
            'body' => $fake->text,
            'url' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $storyFields);
    }
}
