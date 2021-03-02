<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('store_id');
            $table->integer('clicks')->default(0);
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('url');
            $table->boolean('is_active')->default(false);
            $table->text('admin_comment')->nullable();
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
        Schema::drop('stories');
    }
}