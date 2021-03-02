<?php

use Faker\Generator as Faker;
use App\Models\ProductVariant;
use App\Models\ProductSize;

$factory->define(ProductVariant::class, function (Faker $faker) {
    return [
        'color' => $faker->randomElement([
            "#ffffff",
            "#cccccc",
            "#00cadf",
            "#1d66f6",
            "#ff00ff",
            "#ff0000",
            "#f57900",
            "#f8c300",
            "#0ebcbe",
            "#43cb00",
            "#c89673",
            "#ffecc7",
            "#231f20",
            "#666666",
            "#005181",
            "#2e00bc",
            "#662d91",
            "#c1272d",
            "#e24900",
            "#ff9800",
            "#00a385",
            "#47743f",
            "#7d5544",
            "#f5beb8"
        ]),
        'size' => $faker->randomElement(ProductSize::all()->pluck('name')),
        'quantity' => $faker->numberBetween(10, 25),
    ];
});