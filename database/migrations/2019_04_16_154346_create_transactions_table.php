<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('user_id');
            $table->integer('content_id')->nullable();
            $table->string('content_type');
            $table->string('description');
            $table->string('transaction_id');
            $table->string('authorization_code');
            $table->string('billing_document_id');
            $table->float('amount');
            $table->string('status');
            $table->integer('address_id')->nullable();
            $table->text('card_token')->nullable();
            $table->boolean('is_refund')->default(false);
            $table->text('payment_response_json');
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
        Schema::drop('transactions');
    }
}
