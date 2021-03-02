<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Slide;
use Faker\Generator as Faker;

$factory->define(Slide::class, function (Faker $faker) {

    return [
        'body' => $faker->sentence(10),
        'url' => $faker->url,
        'button_text' => $faker->word,
        'button_theme' => $faker->randomElement(['light', 'dark']),
        'order' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});