<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserStoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stores', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('rating')->default(1);
            $table->text('description')->nullable();
            $table->boolean('is_official')->default(false);
            $table->boolean('is_offline')->default(false);
            $table->boolean('is_always_open')->default(true);
            $table->text('opening_hours')->nullable();
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
        Schema::drop('user_stores');
    }
}