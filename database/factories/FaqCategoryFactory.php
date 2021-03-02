<?php

use Faker\Generator as Faker;
use App\Models\FaqCategory;

$factory->define(FaqCategory::class, function (Faker $faker) {
    return [
        'name' =>$faker->sentence(3),
        'description' => $faker->word,
        'slug' => $faker->slug,
    ];
});
