<?php

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Faq::class, 12)->create()->each(function ($faq) {
            $faker = Faker\Factory::create();
                DB::table('faqs_faq_categories')->insert([
                    'faq_id' => $faq->id,
                    'category_id' => $faker->unique()->numberBetween(1, 6),
                ]);
        });
    }
}
