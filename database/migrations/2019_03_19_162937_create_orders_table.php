<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->uuid('uuid')->nullable();
            $table->integer('status_id', false, true);
            $table->integer('user_id', false, true);
            $table->string('shipping_address_id');
            $table->string('billing_address_id')->nullable();
            $table->float('subtotal')->nullable(10, 0);
            $table->float('total_price')->nullable(10, 0);
            $table->text('notes')->nullable();
            $table->integer('coupon_id', false, true)->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('authorization_code')->nullable();
            $table->string('billing_document_id')->nullable();
            $table->text('shipping_data')->nullable();
            $table->text('conditions')->nullable();
            $table->float('local_shipping_price')->nullable();
            $table->float('national_shipping_price')->nullable();
            $table->float('total_shipping_price')->nullable();
            $table->float('coupon_discount')->nullable();
            $table->float('vat_price')->nullable();
            $table->boolean('is_bill_uploaded')->default(false);
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
        Schema::drop('orders');
    }
}
