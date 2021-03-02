<?php

use Faker\Generator as Faker;
use App\Models\Answer;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(3),
        'user_id' => $faker->optional($weight = 0.4)->numberBetween(1, 20),
    ];
});
