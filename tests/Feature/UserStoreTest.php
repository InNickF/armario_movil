<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserStoreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function aUserCanEditItsStore()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/account/store');
        $response->assertStatus(200);


        $newName = $this->faker->name;
        $store = [
            'name' => $newName,
            // 'description' => $this->faker->text,
            // 'email' => $this->faker->email,
            // 'address' => $this->faker->address,
        ];

        $editResponse = $this->actingAs($user)
                        ->withSession(['foo' => 'bar'])
                        ->post('/account/store', $store);

        // $editResponse->assertSee('actualizada');
        $this->assertDatabaseHas('user_stores', [
            'user_id' => $user->id,
            'name' => $newName
        ]);
    }
}
