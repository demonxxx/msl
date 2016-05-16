<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipperLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('longitude')->nullable();
            $table->decimal('latitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shipper_locations');
    }
}
