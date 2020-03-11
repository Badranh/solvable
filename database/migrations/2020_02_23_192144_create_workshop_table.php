<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Title');
            $table->string('Problem');
            $table->string('link');
            $table->integer('owner')->unsigned();
            $table->timestamps();
            $table->integer('nparticipants');
            $table->integer('voted');
            $table->integer('rounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
