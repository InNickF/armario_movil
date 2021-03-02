<?php

use Faker\Generator as Faker;
use App\Models\Review;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(8),
        'rating' => $faker->numberBetween(1, 5),
        'user_id' => $faker->numberBetween(1, 30),
    ];
});
