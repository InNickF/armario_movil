<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{   
    use WithFaker, RefreshDatabase;
   
    /** @test */
    public function anAdminCanViewAllReviews()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $reviews = factory(\App\Models\Review::class, 10)->create();
        
        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/admin/reviews');
        $response->assertStatus(200);
        $response->assertSee('Reseñas');
    }
}
