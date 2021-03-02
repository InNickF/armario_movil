<?php

use App\Models\Story;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(Story::class, 20)->create()->each(function ($story) use ($faker) {
            $exampleImage = $faker->randomElement(['pe-1.png', 'pe-2.png', 'pe-3.png', 'pe-4.png', 'pe-5.png', 'pe-6.png', 'video_example.mp4']);

            $story->addMedia(public_path('images/examples/' . $exampleImage))
                ->withCustomProperties(['isMain' => true])
                ->preservingOriginal()
                ->toMediaCollection('stories');
        });
    }
}