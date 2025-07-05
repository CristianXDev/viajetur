<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cedula')->unique();
            $table->string('telefono')->nullable();
            $table->string('whatsapp')->nullable();
            $table->enum('status', [User::Activo,User::Inactivo,User::Suspendido])->default(User::Activo);
            $table->enum('confirmacion',[User::sinConfirmar,User::confirmado])->default(User::sinConfirmar);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('id_role')->nullable();
            $table->unsignedBigInteger('id_municipio')->nullable();
            $table->foreign('id_role')->references('id')->on('Roles')->onDelete('set null');
            $table->foreign('id_municipio')->references('id')->on('Municipios')->onDelete('set null');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
