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
        Schema::create('mante_repuests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_asignacion');
            $table->unsignedBigInteger('id_repuestos');
            $table->timestamps();

            $table->foreign('id_asignacion')->references('id')->on('assignaments');
            $table->foreign('id_repuestos')->references('id')->on('assignaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mante_repuests');
    }
};
