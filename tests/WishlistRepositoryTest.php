<?php

use App\Models\Wishlist;
use App\Repositories\WishlistRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishlistRepositoryTest extends TestCase
{
    use MakeWishlistTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WishlistRepository
     */
    protected $wishlistRepo;

    public function setUp()
    {
        parent::setUp();
        $this->wishlistRepo = App::make(WishlistRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWishlist()
    {
        $wishlist = $this->fakeWishlistData();
        $createdWishlist = $this->wishlistRepo->create($wishlist);
        $createdWishlist = $createdWishlist->toArray();
        $this->assertArrayHasKey('id', $createdWishlist);
        $this->assertNotNull($createdWishlist['id'], 'Created Wishlist must have id specified');
        $this->assertNotNull(Wishlist::find($createdWishlist['id']), 'Wishlist with given id must be in DB');
        $this->assertModelData($wishlist, $createdWishlist);
    }

    /**
     * @test read
     */
    public function testReadWishlist()
    {
        $wishlist = $this->makeWishlist();
        $dbWishlist = $this->wishlistRepo->find($wishlist->id);
        $dbWishlist = $dbWishlist->toArray();
        $this->assertModelData($wishlist->toArray(), $dbWishlist);
    }

    /**
     * @test update
     */
    public function testUpdateWishlist()
    {
        $wishlist = $this->makeWishlist();
        $fakeWishlist = $this->fakeWishlistData();
        $updatedWishlist = $this->wishlistRepo->update($fakeWishlist, $wishlist->id);
        $this->assertModelData($fakeWishlist, $updatedWishlist->toArray());
        $dbWishlist = $this->wishlistRepo->find($wishlist->id);
        $this->assertModelData($fakeWishlist, $dbWishlist->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWishlist()
    {
        $wishlist = $this->makeWishlist();
        $resp = $this->wishlistRepo->delete($wishlist->id);
        $this->assertTrue($resp);
        $this->assertNull(Wishlist::find($wishlist->id), 'Wishlist should not exist in DB');
    }
}
