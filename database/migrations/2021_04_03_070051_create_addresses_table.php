<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('full_address');
            $table->string('region_with_type')->nullable();
            $table->string('federal_district')->nullable();
            $table->string('area_with_type')->nullable();
            $table->string('city_with_type')->nullable();
            $table->string('city_district_with_type')->nullable();
            $table->string('settlement_with_type')->nullable();
            $table->string('street_with_type')->nullable();
            $table->string('house_type_full')->nullable();
            $table->string('house')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
