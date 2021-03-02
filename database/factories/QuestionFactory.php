<?php

use Faker\Generator as Faker;
use App\Models\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(3),
        'store_id' => $faker->numberBetween(1, 20),
        'user_id' => $faker->numberBetween(1, 20),
        'product_id' => $faker->numberBetween(1, 50),
        'is_active' => $faker->boolean(),
    ];
});
