<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('configs', function (Blueprint $table) {
            //
        });
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('url')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('configs');
    }

}
