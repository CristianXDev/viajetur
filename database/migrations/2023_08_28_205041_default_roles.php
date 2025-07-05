<?php

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fecha = Carbon::now();
#------roles por default----------------------------------
    DB::table('roles')->insert([
        'nombre' => 'administrado',
        'agregar' => Role::Activo,
        'editar' => Role::Activo,
        'borrar' => Role::Activo,
        'bloquear' => Role::Activo,
        'administrar_servicios' => Role::Activo,
        'administrar_usuarios' => Role::Activo,
        'administrar_pagos' => Role::Activo,
        'administrar_roles' => Role::Activo,
        'administrar_estados' => Role::Activo,
        'administrar_destinos' => Role::Activo,
        'administrar_municipios' => Role::Activo,
        'created_at' => $fecha
    ]);
    DB::table('roles')->insert([
        'nombre' => 'asistente',
        'agregar' => Role::Inactivo,
        'editar' => Role::Inactivo,
        'borrar' => Role::Inactivo,
        'bloquear' => Role::Activo,
        'administrar_servicios' => Role::Inactivo,
        'administrar_usuarios' => Role::Activo,
        'administrar_pagos' => Role::Activo,
        'administrar_roles' => Role::Activo,
        'administrar_estados' => Role::Inactivo,
        'administrar_destinos' => Role::Inactivo,
        'administrar_municipios' => Role::Inactivo,
        'created_at' => $fecha
    ]);
    DB::table('roles')->insert([
        'nombre' => 'cliente',
        'agregar' => Role::Inactivo,
        'editar' => Role::Inactivo,
        'borrar' => Role::Inactivo,
        'bloquear' => Role::Inactivo,
        'administrar_servicios' => Role::Inactivo,
        'administrar_usuarios' => Role::Inactivo,
        'administrar_pagos' => Role::Inactivo,
        'administrar_roles' => Role::Inactivo,
        'administrar_estados' => Role::Inactivo,
        'administrar_destinos' => Role::Inactivo,
        'administrar_municipios' => Role::Inactivo,
        'created_at' => $fecha
    ]);
    DB::table('roles')->insert([
        'nombre' => 'proveedor',
        'agregar' => Role::Activo,
        'editar' => Role::Activo,
        'borrar' => Role::Activo,
        'bloquear' => Role::Inactivo,
        'administrar_servicios' => Role::Activo,
        'administrar_usuarios' => Role::Inactivo,
        'administrar_pagos' => Role::Inactivo,
        'administrar_roles' => Role::Inactivo,
        'administrar_estados' => Role::Inactivo,
        'administrar_destinos' => Role::Inactivo,
        'administrar_municipios' => Role::Inactivo,
        'created_at' => $fecha
    ]);
  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
