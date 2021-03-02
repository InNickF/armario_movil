<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->uuid('uuid');
            $table->integer('store_id', false);
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('example_size')->nullable();
            $table->string('condition')->nullable();
            $table->string('style')->nullable();
            $table->text('features')->nullable();
            $table->boolean('is_active')->default(false);
            $table->text('admin_comment')->nullable();
            $table->float('price')->nullable(10, 0);
            $table->boolean('has_discount')->nullable();
            $table->float('discounted_price')->nullable(10, 0);
            $table->float('final_price')->nullable(10, 0);
            $table->boolean('has_guarantee')->default(false);
            $table->integer('guarantee_time_months')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->softDeletes();
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
        Schema::drop('products');
    }
}