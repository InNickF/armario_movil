<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductSizesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name');
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('categories_product_sizes', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->text('category_id');
            $table->integer('product_size_id');
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
        Schema::drop('product_sizes');
    }
}
