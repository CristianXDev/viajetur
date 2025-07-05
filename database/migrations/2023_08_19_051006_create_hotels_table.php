<?php

use App\Models\Hotel;
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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nombre');
            $table->integer('vistas')->default(0);
            $table->integer('reservas')->default(0);
            $table->text('descripcion');
            $table->enum('categoria',['1','2','3','4','5']);
            $table->enum('estado',[Hotel::Activo,Hotel::Inactivo])->default(Hotel::Activo);
            $table->enum('bloqueado',[Hotel::Activo,Hotel::Bloqueado])->default(Hotel::Activo);
            $table->double('precio');
            $table->string('correo')->unique();
            $table->string('telefono')->unique()->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->unsignedBigInteger('id_destino');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_destino')->references('id')->on('destinos')->onDelete('restrict');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
