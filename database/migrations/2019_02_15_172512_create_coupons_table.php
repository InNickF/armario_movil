<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('type');
            $table->string('target');
            $table->float('discount')->nullable();
            $table->integer('available_uses')->nullable();
            $table->integer('uses_count')->nullable();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::drop('coupons');
    }
}