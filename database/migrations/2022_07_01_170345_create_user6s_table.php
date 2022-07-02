<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser6sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user6s', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('name');
            $table->integer('position_id');
            $table->integer('dept_id');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('current');
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
        Schema::dropIfExists('user6s');
    }
}
