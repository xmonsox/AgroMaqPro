<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignaments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('documento');
            $table->unsignedBigInteger('matricula');
            $table->string('descripcion');
            $table->enum('estado', ['Asignada','No_Asignada','Completada']);
            $table->timestamps();

            $table->foreign('id_actividad')->references('id')->on('activities');
            $table->foreign('documento')->references('id')->on('usuarios');
            $table->foreign('matricula')->references('id')->on('machineries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignaments');
    }
};
