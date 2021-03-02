<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function anAdminCanSeeCategoryIndex()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/admin/categories');

        $response->assertStatus(200);
    }


    /** @test */
    public function anAdminCanReorderCategories()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $categories = factory(\App\Models\Category::class, 20)->create();
        
        $catsChanged = [];
        foreach ($categories as $cat) {
            $cat->parent_id = null;
            $cat->order = $this->faker->unique->numberBetween(1, 20);
            $catsChanged[] = $cat->toArray();
        }

        $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->post('/admin/categories/reorder', $catsChanged);

        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', [
            'order' => $catsChanged[0]['order'],
            'parent_id' => $catsChanged[0]['parent_id'],
        ]);
    }

    /** @test */
    public function anAdminCanCreateACategory() {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $categories = factory(\App\Models\Category::class, 19)->create();
        $category = [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->post('/admin/categories', $category);

        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', [
            'name' => $category['name'],
            'slug' => $category['slug'],
        ]);
    }
}
