<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBargainOffersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bargain_offers', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('bargain_id', false);
            $table->integer('user_id', false);
            $table->string('status');
            $table->float('value')->nullable(10, 0);
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
        Schema::drop('bargain_offers');
    }
}
