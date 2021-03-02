<?php

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4, 10),
        'body' => $faker->text,
        'description' => $faker->text,
    ];
});