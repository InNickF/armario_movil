<?php

use Faker\Generator as Faker;
use App\Models\Product;
use function GuzzleHttp\json_encode;
use App\Models\Category;
use App\Models\UserStore;

$factory->define(Product::class, function (Faker $faker) {

    $cat = Category::find($faker->numberBetween(1, 7));
    $subId = $faker->randomElement(Category::where('parent_id', $cat->id)->pluck('id'));
    $subSubId = $faker->randomElement(Category::where('parent_id', $subId)->pluck('id'));

    $styles = [
        "elegant",
        "casual",
        "minimal",
        "sporty",
        "romantic",
        "rocker",
        "hipster",
        "urban",
    ];

    $price = $faker->randomFloat(2, 4, 20);
    $hasDiscount = $faker->boolean();
    $discounted = $hasDiscount ? $faker->randomFloat(2, 1, 10) : null;
    $total = $hasDiscount ? $discounted : $price;
    return [
        'name' => $faker->sentence(3),
        'description' => $faker->sentence(10, 20),
        'store_id' => $faker->numberBetween(1, UserStore::all()->count()),
        'price' => $price,
        'has_discount' => $hasDiscount,
        'discounted_price' => $discounted,
        'final_price' => $total,
        'category_id' => $cat->id,
        'subcategory_id' => $subId,
        'subsubcategory_id' => $subSubId,
        'style' => $faker->randomElement($styles),
        'is_active' => $faker->boolean(95),
        'condition' => ($faker->randomElement(['Nuevo', 'Usado'])),
        'features' => ($faker->randomElements($faker->sentences(3), 3, false)),
        'example_size' => $faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
    ];
});
