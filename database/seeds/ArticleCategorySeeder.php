<?php

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ArticleCategory::class)->create([
            'name' => 'Moda',
            'slug' => 'moda',
            'plan_id' => 6,
            'order' => 1
        ]);

        factory(ArticleCategory::class)->create([
            'name' => 'Fotografía',
            'slug' => 'fotografia',
            'plan_id' => 6,
            'order' => 2
        ]);

        factory(ArticleCategory::class)->create([
            'name' => 'Marketing Digital',
            'slug' => 'marketing-digital',
            'plan_id' => 5,
            'order' => 3
        ]);

        factory(ArticleCategory::class)->create([
            'name' => 'Comercio electrónico',
            'slug' => 'comercio-electronico',
            'plan_id' => 5,
            'order' => 4
        ]);

    }
}
