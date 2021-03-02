<?php

use Faker\Generator as Faker;
use App\Models\UserStore; 

$factory->define(UserStore::class, function (Faker $faker) {
   
    return [
        'name' => $faker->sentence(2),
        // 'email' => $faker->email,
        //  'phone' => '0981234567',
        'is_official' => $faker->boolean,
        'description' => $faker->sentence(20),
        // 'address' => $faker->address,
        // 'latitude' => $faker->randomFloat(2, -0.1807532, -0.1805532),
        // 'longitude' => $faker->randomFloat(2, -78.4679382, -78.4677382),
        // 'state' => $state,
        // 'city' => $city,
        // 'district' => $faker->optional($weight = 0.2, $default = 'QUITO')->randomElement(App\Ubigeo::where('city', $city)->pluck('district')->unique()->toArray()),
        // 'zip_code' => $faker->postcode,
    ];
});
