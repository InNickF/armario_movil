<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function anAdminCanViewAllCoupons()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $user->assign('super-user');

        $coupons = factory(\App\Models\Coupon::class, 50)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/admin/coupons');
        
        $response->assertStatus(200);
        // $response->assertViewHasAll($coupons->toArray());
    }


    /** @test */
    public function anAdminCanCreateACoupon()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $user->assign('super-user');

        $coupon = factory(\App\Models\Coupon::class)->make()->toArray();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->post('/admin/coupons', $coupon);
                         
        if (!$user->store) {
            $response->assertStatus(302);
        } else {
            $response->assertStatus(200);
            $this->assertDatabaseHas('coupons', [
                                                'store_id' => $user->store->id,
                                            ]);
        }
    }



    /** @test */
    public function anAdminCanEditACoupon()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $user->assign('super-user');

        $store = factory(\App\Models\UserStore::class)->create([
            'user_id' => $user->id
        ]);
        
        $coupon = factory(\App\Models\Coupon::class)->create([
            'name' => 'Un cupon'
        ]);

        $this->assertDatabaseHas('coupons', [
            'name' => 'Un cupon',
        ]);

        
        $edit_response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('admin/coupons/'.$coupon->id.'/edit');
        
        $edit_response->assertStatus(200);
        $edit_response->assertSee('Un cupon');
        
        $coupon->name = 'Changed coupon name';

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->patch('/admin/coupons/'.$coupon->id, $coupon->toArray());
         
        $response->assertRedirect('admin/coupons/'.$coupon->id.'/edit');

        $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('admin/coupons/'.$coupon->id.'/edit');
        $response->assertSee('Changed coupon name');
        $this->assertDatabaseHas('coupons', [
                                                'name' => 'Changed coupon name'
                                            ]);
    }

    /** @test */
    public function aUserCannotEditCoupons()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $store = factory(\App\Models\UserStore::class)->create([
            'user_id' =>  $user->id
        ]);

        $coupon = factory(\App\Models\Coupon::class)->create();

        $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('admin/coupons/999/edit');
        
        $response->assertRedirect('admin/coupons');

        //  Try to send post request
        $coupon->name = 'CHanged without permission';
        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->patch('admin/coupons/999', $coupon->toArray());

        $response->assertRedirect('admin/coupons');
    }
}
