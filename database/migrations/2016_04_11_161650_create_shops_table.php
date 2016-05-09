<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->string('home_number',255)->nullable();
            $table->string('home_ward',255)->nullable();
            $table->string('home_district',255)->nullable();
            $table->string('home_city',255)->nullable();
            $table->string('office_number',255)->nullable();
            $table->string('office_ward',255)->nullable();
            $table->string('office_district',255)->nullable();
            $table->string('office_city',255)->nullable();
            $table->integer('account_id')->nullable();
            $table->smallInteger('shop_type')->nullable();
            $table->integer('profile_status')->nullable();
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
        Schema::drop('shop_informations');
    }
}
