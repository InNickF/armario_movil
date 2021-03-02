<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Banner::class, function (Faker $faker) {
    return [
        'name' =>$faker->sentence(3),
        'description' => $faker->sentence(3),
        'url' => $faker->url,
        'location' => $faker->randomElement(['home_top', 'home_bottom', 'category_top', 'category_bottom']),
        'is_active' => true
    ];
});
