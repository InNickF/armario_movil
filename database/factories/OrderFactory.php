<?php

use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\OrderStatus;
use App\User;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status_id' => $faker->numberBetween(1, OrderStatus::count()),
        'user_id' => $faker->numberBetween(1, User::count()),
        'shipping_address_id' => $faker->numberBetween(1, 15),
        'billing_address_id' => $faker->numberBetween(1, 15),
        'total_price' => $faker->randomFloat(2, 10, 500),
        'notes' => $faker->text,
        'coupon_id' => $faker->optional($weight = 0.5)->numberBetween(1, 10),
    ];
});
