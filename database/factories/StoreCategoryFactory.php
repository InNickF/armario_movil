<?php

use Faker\Generator as Faker;
use App\Models\StoreCategory;

$factory->define(StoreCategory::class, function (Faker $faker) {
    return [
        'name' => [ 'en' => $faker->sentence(2), 'es' => $faker->sentence(3) ],
        'description' => [ 'en' => $faker->sentence(8), 'es' => $faker->sentence(8) ],
        'slug' => $faker->slug,
        'parent_id' => $faker->optional($weight = 0.5)->numberBetween(1,20),
    ];
});
