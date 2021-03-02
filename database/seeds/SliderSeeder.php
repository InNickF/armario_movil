<?php

use App\Models\Category;
use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        // Slider Home Top
        $slider = factory(Slider::class)->create([
            'position' => 'home_top',
            'type' => 'slider',
            'name' => 'Slider Home Cabecera',
        ]);

        factory(Slide::class, 5)->create([
            'slider_id' => $slider->id
        ])->each(function ($slide) use ($faker) {
            $slide_image = 'images/sliders/home-slider.png';
            $slide->addMedia(public_path($slide_image))
                ->preservingOriginal()
                ->toMediaCollection('slides');
        });



        // Banner Home Center
        $slider = factory(Slider::class)->create([
            'position' => 'home_banner',
            'type' => 'banner',
            'name' => 'Banner Home',
        ]);

        factory(Slide::class, 5)->create([
            'slider_id' => $slider->id
        ])->each(function ($slide) use ($faker) {

            $faker = Faker\Factory::create();
            $exampleImage = $faker->randomElement(['banner-home.png', 'banner-categories-offers.png']);
            $slide->addMedia(public_path('images/sliders/' . $exampleImage))
                ->preservingOriginal()
                ->toMediaCollection('slides');
        });



        // Banner Home Bottom
        $slider = factory(Slider::class)->create([
            'position' => 'home_bottom',
            'type' => 'banner',
            'name' => 'Slider Home Menú fotográfico',
        ]);
        factory(Slide::class, 5)->create([
            'slider_id' => $slider->id
        ])->each(function ($slide) use ($faker) {

            $faker = Faker\Factory::create();
            $exampleImage = $faker->randomElement(['examples/featured-products-example-2.png', 'examples/featured-products-example-1.png']);
            $slide->addMedia(public_path('images/' . $exampleImage))
                ->preservingOriginal()
                ->toMediaCollection('slides');
        });





        // Banner Category Top & Bottom

        $categories = Category::parents()->get();

        foreach ($categories as $key => $category) {
            $slider = factory(Slider::class)->create([
                'position' => 'category_top',
                'type' => 'banner',
                'name' => 'Banner ' . $category->name . ' Arriba',
                'category_id' => $category->id
            ]);

            factory(Slide::class, 3)->create([
                'slider_id' => $slider->id
            ])->each(function ($slide) use ($faker) {

                $faker = Faker\Factory::create();
                $exampleImage = $faker->randomElement(['banner-home.png', 'banner-categories-offers.png']);
                $slide->addMedia(public_path('images/sliders/' . $exampleImage))
                    ->preservingOriginal()
                    ->toMediaCollection('slides');
            });


            $slider = factory(Slider::class)->create([
                'position' => 'category_bottom',
                'type' => 'banner',
                'name' => 'Banner ' . $category->name . ' Abajo',
                'category_id' => $category->id
            ]);

            factory(Slide::class, 3)->create([
                'slider_id' => $slider->id
            ])->each(function ($slide) use ($faker) {

                $faker = Faker\Factory::create();
                $exampleImage = $faker->randomElement(['banner-home.png', 'banner-categories-offers.png']);
                $slide->addMedia(public_path('images/sliders/' . $exampleImage))
                    ->preservingOriginal()
                    ->toMediaCollection('slides');
            });
        }
    }
}
