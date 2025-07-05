<?php

use App\Models\Paquete;
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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nombre')->nullable();
            $table->integer('dias');
            $table->integer('noches');
            $table->text('descripcion')->nullable();
            $table->enum('estado',[Paquete::Disponible,Paquete::NoDisponible])->default(Paquete::Disponible);
            $table->enum('bloqueado',[Paquete::Activo,Paquete::Bloqueado])->default(Paquete::Activo);
            $table->integer('vistas')->default(0)->increments();
            $table->integer('reservas')->default(0)->increments();
            $table->double('precio');
            $table->unsignedBigInteger('id_destino');
            $table->unsignedBigInteger('id_hotel')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_destino')->references('id')->on('destinos')->onDelete('restrict');
            $table->foreign('id_hotel')->references('id')->on('hotels')->onDelete('restrict');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->string('capacidad'); #-- AGREGADO POR CRISTIAN --
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquetes');
    }
};
