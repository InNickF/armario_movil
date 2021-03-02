<?php

use Illuminate\Database\Seeder;
use App\Models\StoreCategory;

class StoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        factory(StoreCategory::class, 20)->create()->each(function ($cat) {
            
            $faker = Faker\Factory::create();
            for ($i = 0; $i < 5; $i++) {
                DB::table('store_store_category')->insert([
                    'store_category_id' => $cat->id,
                    'store_id' => $faker->numberBetween(1, 500),
                ]);
            }
        });




    }
}

