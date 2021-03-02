<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('payment_methods', function (Blueprint $table) {
			$table->integer('id', true, true);
			$table->integer('user_id');
			$table->string('person_type')->nullable();
			$table->string('document_type')->nullable();
			$table->string('document_number')->nullable();
			$table->string('name');
			$table->integer('bank_id')->nullable();
			$table->string('account_type')->nullable();
			$table->string('account_number')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->boolean('is_card')->nullable();
			$table->boolean('is_primary')->nullable();
			$table->text('card_token')->nullable();
			$table->boolean('is_collecting')->nullable();
			$table->boolean('is_paying')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('payment_methods');
	}
}
