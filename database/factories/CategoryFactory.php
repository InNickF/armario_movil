<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        // 'description' =>  $faker->sentence(8),
        'slug' => $faker->slug(2),
    ];
});
