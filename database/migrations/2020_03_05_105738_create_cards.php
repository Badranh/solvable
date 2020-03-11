<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCards extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('text');
            $table->integer('score');
            $table->integer('user_id')->unsigned();
            $table->integer('workshop_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cards');
    }
}
