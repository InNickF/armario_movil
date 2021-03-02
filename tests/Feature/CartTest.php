<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    // public function AUserCanAddAProductToCart()
    // {
    //     $this->withoutExceptionHandling();

    //     $user = factory(\App\User::class)->create();
    //     $product = factory(Product::class)->create();

    //     $response = $this->actingAs($user, 'api')
    //     ->withSession(['foo' => 'bar'])
    //     ->post('/api/cart', [
    //         'product_id' => $product->id,
    //         'quantity' => 23
    //     ]);
    //     $response->assertStatus(200);

    //     $cartProduct = \Cart::session($user->id)->get($product->id);
    //     $cartCollection = \Cart::getContent();
    //     $this->assertEquals($cartCollection->count(), 1);
    //     $this->assertEquals($cartProduct['id'], $product->id);
    //     $this->assertEquals($cartProduct['quantity'], 23);
    // }


    /** @test */
    // public function AUserCanSeeItsCartProducts()
    // {
    //     $this->withoutExceptionHandling();

    //     $user = factory(\App\User::class)->create();
    //     $product = factory(Product::class)->create();

    //     $response = $this->actingAs($user, 'api')
    //     ->withSession(['foo' => 'bar'])
    //     ->post('/api/cart', [
    //         'product_id' => $product->id,
    //         'quantity' => 23
    //     ]);
    //     $response->assertStatus(200);

    //     $cartProduct = \Cart::session($user->id)->get($product->id);
    //     $cartCollection = \Cart::getContent();
    //     $this->assertEquals($cartCollection->count(), 1);
    //     $this->assertEquals($cartProduct['id'], $product->id);
    //     $this->assertEquals($cartProduct['quantity'], 23);


    //     $response = $this->actingAs($user, 'api')
    //     ->withSession(['foo' => 'bar'])
    //     ->get('/cart');
    //     $response->assertStatus(200);
    //     // $response->assertSee(23);
    //     $response->assertSee('cart');
    // }
}
