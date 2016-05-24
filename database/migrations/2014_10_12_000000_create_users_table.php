<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('identity_card')->nullable();
            $table->smallInteger('user_type')->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('api_token', 60)->unique();
            $table->string('avatar')->nullable();
            $table->text('gcm_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
