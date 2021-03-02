<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function loginScreenIsDisplayed()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        $response->assertSee('Bienvenido');
    }

    /** @test */
    public function aUserCanRegisterAndLogin()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ];
        $this->post('/register', $attributes);

        $attributesCreated = [
            'email' => $attributes['email'],
            'name' => $attributes['name'],
            // 'password' => Hash::make('123123123'),
        ];
        $this->assertDatabaseHas('users', $attributesCreated);

        $attributesLogin = [
            'email' => $attributes['email'],
            'password' => '123123123',
        ];

        $response = $this->post('/login', $attributes);

        // $response->assertStatus(200);
        $response->assertRedirect('/');
    }
}
