<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string("id")->comment("чтобы построить связь между версиями");
            $table->string("version")->comment("Почему версия – это время? Исторические срезы: можно посмотреть,
            как выглядела БД в определенное время
            - Устойчиво к конфликтам репликации");
            $table->string('name');
            $table->string('surname');
            $table->integer("position_id");
            $table->integer('dept_id');
            $table->dateTime('data_start');
            $table->dateTime('date_end');
            $table->boolean("current");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
