<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('order_id', false, true);
            $table->integer('product_variant_id', false, true);
            $table->integer('quantity', false, true);
            $table->text('shipping_order_id')->nullable();
            $table->string('status')->default('Pendiente');
            $table->float('unit_price_subtotal', 10, 0);
            $table->float('unit_price_final', 10, 0);
            $table->float('sum_price_subtotal', 10, 0);
            $table->float('sum_price_final', 10, 0);
            $table->float('commission_percentage', 10, 0);
            $table->float('commission_price', 10, 0);
            $table->float('vat_price', 10, 0);
            $table->integer('coupon_id')->nullable();
            $table->float('coupon_discount', 10, 0)->nullable();
            $table->float('earning', 10, 0);
            $table->text('conditions')->nullable();
            $table->text('admin_comment')->nullable();
            $table->boolean('is_valid_store_bill')->default(false);
            $table->boolean('is_paid_earning')->default(false);
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
        Schema::drop('order_items');
    }
}