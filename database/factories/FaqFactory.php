<?php

use Faker\Generator as Faker;
use App\Models\Faq;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'title' =>$faker->sentence(3),
        'body' => $faker->text,
        'description' => $faker->text,
        'user_id' => $faker->numberBetween(1, 20),
    ];
});
