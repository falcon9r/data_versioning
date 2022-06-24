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
            $table->id();
            $table->string("token")->comment("чтобы построить связь между версиями");
            $table->string('name');
            $table->string('surname');
            $table->integer("position_id");
            $table->integer('dept_id');
            $table->dateTime('date_start')->comment("Почему версия – это время? Исторические срезы: можно посмотреть,
            как выглядела БД в определенное время
            - Устойчиво к конфликтам репликации");
            $table->dateTime('date_end');
            $table->integer("current");
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
        Schema::dropIfExists('users');
    }
}
