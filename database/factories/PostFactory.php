<?php

use App\Models\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4,10),
        'body' => $faker->text,
        'description' => $faker->text,
        'user_id' => $faker->randomElement(User::whereIs('super-user')->get()->pluck('id'))
    ];
});
