<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaqCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('is_active')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('faqs_faq_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('faq_id');
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
        Schema::drop('faq_categories');
        Schema::drop('faqs_faq_categories');
    }
}
