<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->smallInteger('satisfy_level')->nullable();
            $table->float('score')->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::drop('shipper_contract');
    }
}
