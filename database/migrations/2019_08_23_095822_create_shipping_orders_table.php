<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_orders', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('order_id', false, true);
            $table->float('price', 10, 0);
            $table->string('provider');
            $table->string('code');
            $table->integer('store_id')->nullable();
            $table->string('status');
            $table->string('tracking_number');
            $table->text('tracking_history_json');
            $table->text('provider_order_json');
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
        Schema::drop('shipping_orders');
    }
}