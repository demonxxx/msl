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
            $table->string('code')->nullable();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('start_date')->comment('start date of contract');
            $table->date('end_date')->comment('end date of contract');
            $table->smallInteger('status')->default(1)->comment('status of contract, 1: ongoing, 2: completed, 3: cancel');
            $table->text('description')->nullable()->comment('description of contract');
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
        Schema::drop('contracts');
    }
}
