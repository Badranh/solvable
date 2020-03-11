<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IterationAndWspos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->integer('iteration')->unsigned();
            $table->integer('workshop_pos')->unsigned();
        });
        Schema::table('workshops', function (Blueprint $table) {
            $table->integer('voted')->unsigned();
            $table->integer('rounds')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'workshop_pos')) {
                $table->dropColumn('workshop_pos');
            }
        });
        Schema::table('workshops', function (Blueprint $table) {
            if (Schema::hasColumn('workshops', 'iteration')) {
                $table->dropColumn('iteration');
            }
        });
    }
}
