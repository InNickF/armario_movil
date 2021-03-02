<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaticBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_banners', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('store_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->string('url')->nullable();
            $table->boolean('is_active');
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
        Schema::drop('static_banners');
    }
}
