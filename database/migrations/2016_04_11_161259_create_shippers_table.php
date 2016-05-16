<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('home_number',255)->nullable();
            $table->string('home_ward',255)->nullable();
            $table->string('home_district',255)->nullable();
            $table->string('home_city',255)->nullable();
            $table->string('office_number',255)->nullable();
            $table->string('office_ward',255)->nullable();
            $table->string('office_district',255)->nullable();
            $table->string('office_city',255)->nullable();
            $table->integer('account_id')->nullable();
            $table->smallInteger('vehicle_type')->nullable();
            $table->string('licence_plate')->nullable();
            $table->smallInteger('shipper_type')->nullable();
            $table->smallInteger('month_register')->nullable();
            $table->smallInteger('insurance_level')->nullable();
            $table->float('average_score')->nullable();
            $table->integer('profile_status')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
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
        Schema::drop('shipper_informations');
    }
}
