<?php

use App\Models\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name,
        'code' => $this->faker->word,
        'type' => $this->faker->randomElement(['percentage', 'money']),
        'target' => $this->faker->randomElement(['products', 'plans']),
        'discount' => $this->faker->numberBetween(1, 99),
        'available_uses' => $this->faker->numberBetween(1, 500),
        'uses_count' => $this->faker->numberBetween(1, 500),
        'is_active' => $this->faker->boolean,
    ];
});
