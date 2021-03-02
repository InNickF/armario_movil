<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->rememberToken();
            $table->string('fcm_token')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('facebook_token')->nullable();
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
