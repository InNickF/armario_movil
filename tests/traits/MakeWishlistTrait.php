<?php

use Faker\Factory as Faker;
use App\Models\Wishlist;
use App\Repositories\WishlistRepository;

trait MakeWishlistTrait
{
    /**
     * Create fake instance of Wishlist and save it in database
     *
     * @param array $wishlistFields
     * @return Wishlist
     */
    public function makeWishlist($wishlistFields = [])
    {
        /** @var WishlistRepository $wishlistRepo */
        $wishlistRepo = App::make(WishlistRepository::class);
        $theme = $this->fakeWishlistData($wishlistFields);
        return $wishlistRepo->create($theme);
    }

    /**
     * Get fake instance of Wishlist
     *
     * @param array $wishlistFields
     * @return Wishlist
     */
    public function fakeWishlist($wishlistFields = [])
    {
        return new Wishlist($this->fakeWishlistData($wishlistFields));
    }

    /**
     * Get fake data of Wishlist
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWishlistData($wishlistFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'user_id' => $fake->randomDigitNotNull,
            'product_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $wishlistFields);
    }
}
