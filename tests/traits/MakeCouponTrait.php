<?php

use Faker\Factory as Faker;
use App\Models\Coupon;
use App\Repositories\CouponRepository;

trait MakeCouponTrait
{
    /**
     * Create fake instance of Coupon and save it in database
     *
     * @param array $couponFields
     * @return Coupon
     */
    public function makeCoupon($couponFields = [])
    {
        /** @var CouponRepository $couponRepo */
        $couponRepo = App::make(CouponRepository::class);
        $theme = $this->fakeCouponData($couponFields);
        return $couponRepo->create($theme);
    }

    /**
     * Get fake instance of Coupon
     *
     * @param array $couponFields
     * @return Coupon
     */
    public function fakeCoupon($couponFields = [])
    {
        return new Coupon($this->fakeCouponData($couponFields));
    }

    /**
     * Get fake data of Coupon
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCouponData($couponFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'name' => $fake->word,
            'description' => $fake->text,
            'type' => $fake->word,
            'discount' => $fake->randomDigitNotNull,
            'available_uses' => $fake->randomDigitNotNull,
            'uses_count' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $couponFields);
    }
}
