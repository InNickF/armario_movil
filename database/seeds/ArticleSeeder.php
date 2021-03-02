<?php

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 12)->create()->each(function($category) {
            $faker = Faker\Factory::create();
            for ($i = 0; $i < 3; $i++) {
                DB::table('articles_article_categories')->insert([
                    'article_id' => $category->id,
                    'category_id' => $faker->unique()->numberBetween(1, 4),
                ]);
            }
        });
    }
}
