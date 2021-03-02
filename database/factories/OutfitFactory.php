<?php

use App\Models\Category;
use Faker\Generator as Faker;
use App\Models\UserStore;

$factory->define(App\Models\Outfit::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'description' => $faker->sentence(10, 20),
        'store_id' => $faker->numberBetween(1, UserStore::all()->count()),
        'is_active' => $faker->boolean,
        'features' => ($faker->randomElements($faker->sentences(3), 3, false)),
    ];
});
