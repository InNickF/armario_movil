<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('slug');
            $table->string('name');
            $table->text('description');
            $table->boolean('is_active')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('posts_post_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('post_id');
            $table->text('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_categories');
        Schema::drop('posts_post_categories');
    }
}
