<?php

use App\Models\UserStore;
use Faker\Generator as Faker;

$factory->define(App\Models\Story::class, function (Faker $faker) {
    return [
       'title' => $faker->sentence(6),
       'body' => $faker->sentence(20),
       'url' => $faker->url,
       'store_id' => $faker->randomElement(UserStore::all()->pluck('id')),
       'is_active' => $faker->boolean(90),
    ];
});
