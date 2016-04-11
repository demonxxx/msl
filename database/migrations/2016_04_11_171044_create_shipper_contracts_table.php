<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipperContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper_contract', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('shipper_id');
            $table->date('start_time');
            $table->date('end_time');
            $table->smallInteger('satisfy_level');
            $table->float('score');
            $table->smallInteger('status');
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
        Schema::drop('shipper_contract');
    }
}
