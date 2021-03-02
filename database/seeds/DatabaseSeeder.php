<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call(UsersSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OutfitSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(StorySeeder::class);
        $this->call(PostSeeder::class);
    }
}