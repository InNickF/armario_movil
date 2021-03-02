<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOutfitsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outfits', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->integer('store_id', false);
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::drop('outfits');
    }
}