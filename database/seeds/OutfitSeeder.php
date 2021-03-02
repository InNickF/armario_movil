<?php

use App\Models\Outfit;
use Illuminate\Database\Seeder;
use App\Models\Product;

class OutfitSeeder extends Seeder
{

    public function run()
    {
        factory(Outfit::class, 2)->create([
            'store_id' => 1
        ])->each(function ($outfit) {
            $this->makeData($outfit);
        });

        factory(Outfit::class, 10)->create()->each(function ($outfit) {
            $this->makeData($outfit);
        });
    }


    public function makeData($outfit)
    {
        $faker = Faker\Factory::create();

        // Add products
        for ($i = 1; $i < $faker->numberBetween(3, 5); $i++) {
            $outfit->products()->save(Product::find($faker->numberBetween(1, Product::all()->count())), ['order' => $i]);
        }

        for ($i = 1; $i <= $faker->numberBetween(2, 4); $i++) {
            $exampleImage = $faker->randomElement(['pe-1.png', 'pe-2.png', 'pe-3.png', 'pe-4.png', 'pe-5.png', 'pe-6.png']);
            $outfit->addMedia(public_path('images/examples/' . $exampleImage))
                ->withCustomProperties(['key' => 'image_' . $i])
                ->preservingOriginal()
                ->toMediaCollection('outfits');
        }

        $outfit->addMedia(public_path('images/examples/video_example.mp4'))
            ->withCustomProperties(['key' => 'video'])
            ->preservingOriginal()
            ->toMediaCollection('outfits');
    }
}
