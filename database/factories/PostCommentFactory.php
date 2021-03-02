<?php

use App\Models\Post;
use Faker\Generator as Faker;
use App\Models\PostComment;
use App\User;

$factory->define(PostComment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(8),
        'user_id' => $faker->randomElement(User::all()->pluck('id')),
        'post_id' => $faker->randomElement(Post::all()->pluck('id')),
    ];
});
