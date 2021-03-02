<?php

use Faker\Generator as Faker;
use App\Models\Address;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'secondary_street' => $faker->streetName,
        'property_number' => $faker->numberBetween(123, 54234),
        'reference' => $faker->sentence(4),
        'province_id' => $faker->numberBetween(1, 25),
        'city_id' => $faker->numberBetween(1, 25),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'is_default' => true,
        'ubigeo_id' => $faker->numberBetween(1, 300),
        'document_number' => $faker->numberBetween(170000000000, 1800000000000),
        'email' => $faker->email,
        'phone' => '0981234567',
    ];
});