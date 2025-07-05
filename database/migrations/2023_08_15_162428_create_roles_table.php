<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->boolean('agregar')->default(Role::Inactivo);
            $table->boolean('editar')->default(Role::Inactivo);
            $table->boolean('borrar')->default(Role::Inactivo);
            $table->boolean('bloquear')->default(Role::Inactivo);
            $table->boolean('administrar_servicios')->default(Role::Inactivo);
            $table->boolean('administrar_usuarios')->default(Role::Inactivo);
            $table->boolean('administrar_pagos')->default(Role::Inactivo);
            $table->boolean('administrar_roles')->default(Role::Inactivo);
            $table->boolean('administrar_estados')->default(Role::Inactivo);
            $table->boolean('administrar_destinos')->default(Role::Inactivo);
            $table->boolean('administrar_municipios')->default(Role::Inactivo);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
