<?php

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Question::class, 40)->create()->each(function ($question) {
            $faker = Faker\Factory::create();

            factory(Answer::class, 3)->create([
                'question_id' => $question->id
            ]);
        });
    }
}
