<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

    $state = $faker->randomElement(App\Ubigeo::pluck('state')->unique()->toArray());
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'phone' => '0981234567',
        'country' => 'EC',
        'state' => $state,
        'city' => $faker->randomElement(App\Ubigeo::where('state', $state)->pluck('city')->unique()->toArray()),
        'gender' => $faker->randomElement(['male', 'female']),
        'dob' => $faker->dateTimeBetween('-50 years', '-18 years'),
    ];
});
