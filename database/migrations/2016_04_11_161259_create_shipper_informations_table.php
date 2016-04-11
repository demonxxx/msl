<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipperInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('id_card');
            $table->string('phone');
            $table->string('home_address',300);
            $table->string('office_address',300);
            $table->integer('account_id');
            $table->smallInteger('vehicle_type');
            $table->string('license_plate');
            $table->smallInteger('shipper_type');
            $table->smallInteger('month_register');
            $table->smallInteger('insurance_level');
            $table->float('average_score');
            $table->integer('profile_status');
            $table->integer('likes');
            $table->integer('dislikes');
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
        Schema::drop('shipper_informations');
    }
}
