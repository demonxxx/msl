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
            $table->string('home_number',255)->nullable();
            $table->string('home_ward',255)->nullable();
            $table->string('home_district',255)->nullable();
            $table->string('home_city',255)->nullable();
            $table->string('office_number',255)->nullable();
            $table->string('office_ward',255)->nullable();
            $table->string('office_district',255)->nullable();
            $table->string('office_city',255)->nullable();
            $table->string('avatar',255)->nullable();
            $table->integer('account_id')->nullable()->references('id')->on('accounts')->onDelete('cascade');
            $table->smallInteger('shop_scope_id')->nullable()->references('id')->on('shop_scopes')->onDelete('cascade')->comment('scope of shop ex');
            $table->smallInteger('shop_type_id')->nullable()->references('id')->on('shop_types')->onDelete('cascade');
            $table->smallInteger('isActive')->default(1)->comment('0: not active, 1:activated ');
            $table->integer('profile_status')->nullable()->commnet('percent of complete profile status, ex: 90%');
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
        Schema::drop('shops');
    }
}
