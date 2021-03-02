<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use function GuzzleHttp\json_decode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Requests\Admin\CreateProductRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function anAdminCanCreateAProduct()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();


        $product = factory(Product::class)->make();
        // $product->main_image = "['images/image.jpg']";

        // $product->images = [
        //     'images/image.jpg',
        //     'images/image.jpg'
        // ];
        
        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->post('/admin/products', $product->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('admin/products');


        $this->assertDatabaseHas('products', [
            'name' => $product->name
        ]);
    }



    /** @test */
    public function aUserCanViewItsProducts()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $store = factory(\App\Models\UserStore::class)->create([
            'user_id' =>  $user->id
        ]);

        $products = factory(\App\Models\Product::class, 20)->create([
            'store_id' => $store->id
        ]);

        $this->assertDatabaseHas('products', [
            'store_id' => $store->id,
        ]);

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/account/products');
        
        if (!$user->store) {
            $response->assertStatus(302);
        } else {
            $response->assertStatus(200);
            $response->assertSee('Productos');
        }
    }


    /** @test */
    public function aUserCanCreateAProduct()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $store = factory(\App\Models\UserStore::class)->create([
            'user_id' =>  $user->id
        ]);


        $product = factory(Product::class)->make([
            'store_id' => $store->id
        ]);
        // $product->main_image = "['images/image.jpg']";

        // $product->images = [
        //     'images/image.jpg',
        //     'images/image.jpg'
        // ];
        
        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->post('/account/products', $product->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('account/products');
     
        $this->assertDatabaseHas('products', [
            'name' => $product->name
        ]);
    }





    /** @test */
    public function aUserCanViewAListOfProducts()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $users = factory(\App\User::class, 20)->create();

        $stores = factory(\App\Models\UserStore::class, 21)->create([
            'user_id' =>  $this->faker->unique()->numberBetween(1, 21)
        ]);

        $products = factory(\App\Models\Product::class, 63)->create([
            'store_id' => $this->faker->numberBetween(1, 21)
        ]);

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/products');
        
       
        $response->assertStatus(200);
        $response->assertSee('Productos');
    }


    /** @test */
    public function aUserCanViewAnyProductDetails()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $store = factory(\App\Models\UserStore::class)->create([
            'user_id' =>  $user->id
        ]);

        $product = factory(\App\Models\Product::class)->create([
            'store_id' => $store->id
        ]);

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/products/' . $product->id);
        
       
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

}
