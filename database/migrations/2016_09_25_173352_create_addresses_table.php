<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create(config('rinvex.addresses.tables.addresses'), function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->morphs('addressable');
            $table->string('given_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('label')->nullable();
            $table->string('organization')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('street')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_billing')->default(false);
            $table->boolean('is_shipping')->default(false);
            // Custom fields
            $table->boolean('is_paying')->default(false);
            $table->boolean('is_collecting')->default(false);
            $table->integer('ubigeo_id')->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_type')->nullable();
            $table->boolean('skip_document')->nullable();
            $table->string('property_number')->nullable();
            $table->string('secondary_street')->nullable();
            $table->string('reference')->nullable();
            $table->string('district')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            // End custom
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('rinvex.addresses.tables.addresses'));
    }
}