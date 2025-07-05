<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->dateTime('fecha_pago');
            $table->dateTime('fecha_reserva');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_paquete');
            #$table->unsignedBigInteger('id_proveedor');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('id_paquete')->references('id')->on('paquetes')->onUpdate('cascade');
            $table->string('metodo_pago');
            $table->string('personas')->nullable();
            $table->string('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
