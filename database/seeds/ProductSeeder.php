<?php

use App\Models\Answer;
use App\Models\Review;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)->create([
            'store_id' => 1
        ])->each(function ($product) {
            $this->makeData($product);
        });

        factory(Product::class, 25)->create()->each(function ($product) {
            $this->makeData($product);
        });
    }


    public function makeData($product)
    {
        $faker = Faker\Factory::create();

        $plan = app('rinvex.subscriptions.plan')->where('slug', $faker->randomElement(['cool', 'chic', 'fashion']))->first();

        $product->newSubscription('main', $plan);


        // Add variants
        for ($i = 1; $i < $faker->numberBetween(3, 5); $i++) {
            $variant = factory(ProductVariant::class)->create([
                'product_id' => $product->id,
            ]);
        }

        foreach ($product->colors as $color) {

            for ($i = 1; $i <= $faker->numberBetween(2, 3); $i++) {
                $exampleImage = $faker->randomElement(['pe-1.png', 'pe-2.png', 'pe-3.png', 'pe-4.png', 'pe-5.png', 'pe-6.png']);
                $product->addMedia(public_path('images/examples/' . $exampleImage))
                    ->withCustomProperties(['color' => $color, 'key' => 'image_' . $i])
                    ->preservingOriginal()
                    ->toMediaCollection('products');
            }

            $product->addMedia(public_path('images/examples/video_example.mp4'))
                ->withCustomProperties(['color' => $color, 'key' => 'video_4'])
                ->preservingOriginal()
                ->toMediaCollection('products');
        }
        factory(Question::class, $faker->numberBetween(1, 2))->create([
            'product_id' => $product->id,
        ])->each(function ($question) {
            factory(Answer::class, 1)->create([
                'question_id' => $question->id,
            ]);
        });
    }
}
