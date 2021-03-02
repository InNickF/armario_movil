<?php


use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostComment;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 25)->create()->each(function ($post) {
            $faker = Faker\Factory::create();

            $post->addMedia(public_path('images/examples/armario.png'))
                ->withCustomProperties(['isMain' => true])
                ->preservingOriginal()
                ->toMediaCollection('blog');

            for ($i = 0; $i < 3; $i++) {
                DB::table('posts_post_categories')->insert([
                    'post_id' => $post->id,
                    'category_id' => $faker->randomElement(PostCategory::all()->pluck('id')),
                ]);

                factory(PostComment::class)->create([
                    'post_id' => $post->id,
                ]);
            }
        });
    }
}
