<?php

use Faker\Factory as Faker;
use App\Models\Question;
use App\Repositories\QuestionRepository;

trait MakeQuestionTrait
{
    /**
     * Create fake instance of Question and save it in database
     *
     * @param array $questionFields
     * @return Question
     */
    public function makeQuestion($questionFields = [])
    {
        /** @var QuestionRepository $questionRepo */
        $questionRepo = App::make(QuestionRepository::class);
        $theme = $this->fakeQuestionData($questionFields);
        return $questionRepo->create($theme);
    }

    /**
     * Get fake instance of Question
     *
     * @param array $questionFields
     * @return Question
     */
    public function fakeQuestion($questionFields = [])
    {
        return new Question($this->fakeQuestionData($questionFields));
    }

    /**
     * Get fake data of Question
     *
     * @param array $postFields
     * @return array
     */
    public function fakeQuestionData($questionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'body' => $fake->text,
            'user_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'store_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $questionFields);
    }
}
