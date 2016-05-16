<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencys', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('code')->comment('Code of agencies of user, ex: AGC123');
            $table->string('name')->comment('name of agencies, ex: Shop 1, Shop2, Shop3');
            $table->string('shop_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->integer('province_id')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::drop('agencys');
    }
}
