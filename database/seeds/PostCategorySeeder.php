<?php

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PostCategory::class)->create([
            'name' => 'Moda',
            'slug' => 'moda',
            'order' => 1
        ]);

        factory(PostCategory::class)->create([
            'name' => 'Novedades',
            'slug' => 'novedades',
            'order' => 2
        ]);

        factory(PostCategory::class)->create([
            'name' => 'Compras',
            'slug' => 'compras',
            'order' => 3
        ]);

        factory(PostCategory::class)->create([
            'name' => 'Promociones',
            'slug' => 'promociones',
            'order' => 4
        ]);

    }
}
