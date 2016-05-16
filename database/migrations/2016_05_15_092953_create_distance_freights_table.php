<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistanceFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distance_freights', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->comment('name of freight follow distance');
            $table->string('code')->comment('code of freight follow distance, ex: FR123');
            $table->float('from')->comment("from km");
            $table->float('to')->comment("to km");
            $table->float('freight');
            $table->integer('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
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
        Schema::drop('distance_freights');
    }
}
