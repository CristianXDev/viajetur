<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('proforma_hotels', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->dateTime('fecha_pago');
            $table->dateTime('fecha_reserva');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_hotel');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('id_hotel')->references('id')->on('hotels')->onUpdate('cascade');
            $table->string('metodo_pago');
            $table->string('personas')->nullable();
            $table->string('estatus');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proforma_hotels');
    }
};

