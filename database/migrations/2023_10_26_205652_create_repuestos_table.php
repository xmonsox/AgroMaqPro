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
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->string('nombre');
            $table->enum('tipo_repuesto', ['Filtros','Correas','Cuchillas','Neumáticos','Piezas de motor','Piezas de transmisión','Rodamientos'
            ,'Componentes hidráulicos','Componentes eléctricos:','Sensores y sistemas de control','Accesorios y implementos'
            ,'Partes de la cabina','Sistemas de escape', 'Herramientas y consumibles']);
            $table->integer('cantidad');
            $table->integer('precio_compra');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_proveedor');
            $table->enum('estado', ['Disponible','Pedir']);
            $table->timestamps();

            $table->foreign('id_proveedor')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repuestos');
    }
};
