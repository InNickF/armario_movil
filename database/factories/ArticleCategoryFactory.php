<?php

use Faker\Generator as Faker;
use App\Models\ArticleCategory;

$factory->define(ArticleCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'slug' => $faker->slug,
        'description' => $faker->text,
        'order' => $faker->unique()->numberBetween(1,100),
    ];
});
