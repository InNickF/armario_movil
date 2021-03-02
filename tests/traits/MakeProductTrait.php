<?php

use Faker\Factory as Faker;
use App\Models\Product;
use App\Repositories\ProductRepository;

trait MakeProductTrait
{
    /**
     * Create fake instance of Product and save it in database
     *
     * @param array $productFields
     * @return Product
     */
    public function makeProduct($productFields = [])
    {
        /** @var ProductRepository $productRepo */
        $productRepo = App::make(ProductRepository::class);
        $theme = $this->fakeProductData($productFields);
        return $productRepo->create($theme);
    }

    /**
     * Get fake instance of Product
     *
     * @param array $productFields
     * @return Product
     */
    public function fakeProduct($productFields = [])
    {
        return new Product($this->fakeProductData($productFields));
    }

    /**
     * Get fake data of Product
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProductData($productFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'store_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'slug' => $fake->word,
            'description' => $fake->text,
            'is_active' => $fake->word,
            'has_discount' => $fake->word,
            'quantity' => $fake->randomDigitNotNull,
            'price' => $fake->randomDigitNotNull,
            'category_id' => $fake->randomDigitNotNull,
            'package_width' => $fake->word,
            'package_height' => $fake->word,
            'package_depth' => $fake->word,
            'package_weight' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $productFields);
    }
}
