<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishlistApiTest extends TestCase
{
    use MakeWishlistTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWishlist()
    {
        $wishlist = $this->fakeWishlistData();
        $this->json('POST', '/api/v1/wishlists', $wishlist);

        $this->assertApiResponse($wishlist);
    }

    /**
     * @test
     */
    public function testReadWishlist()
    {
        $wishlist = $this->makeWishlist();
        $this->json('GET', '/api/v1/wishlists/'.$wishlist->id);

        $this->assertApiResponse($wishlist->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWishlist()
    {
        $wishlist = $this->makeWishlist();
        $editedWishlist = $this->fakeWishlistData();

        $this->json('PUT', '/api/v1/wishlists/'.$wishlist->id, $editedWishlist);

        $this->assertApiResponse($editedWishlist);
    }

    /**
     * @test
     */
    public function testDeleteWishlist()
    {
        $wishlist = $this->makeWishlist();
        $this->json('DELETE', '/api/v1/wishlists/'.$wishlist->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/wishlists/'.$wishlist->id);

        $this->assertResponseStatus(404);
    }
}
