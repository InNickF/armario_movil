<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('is_active')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('order');
            $table->integer('plan_id');
            $table->timestamps();
        });

        Schema::create('articles_article_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('article_id');
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
        Schema::drop('article_categories');
        Schema::drop('articles_article_categories');
    }
}
