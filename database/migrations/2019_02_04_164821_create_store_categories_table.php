<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->integer('parent_id')->nullable(false, true);
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
        Schema::drop('store_categories');
    }
}
