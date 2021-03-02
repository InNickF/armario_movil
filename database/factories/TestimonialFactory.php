<?php

use Faker\Generator as Faker;
use App\Models\Testimonial;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'body' => $faker->word,
        'user_id' => $faker->numberBetween(1, 20),
    ];
});
