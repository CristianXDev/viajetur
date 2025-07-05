<?php

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
        DB::table('municipios')->insert([
            'nombre' => 'Bolivar',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Camatagua',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Francisco Linares Alcántara',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Girardot',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'José Ángel Lamas',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'José Félix Rivas',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'José Rafael Revenga',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Libertador',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Mario Briceño Irogorry',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Ocumare de la Costa de Oro',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Casimiro',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'San Sebastián',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Santiago Mariño',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Santos Michelena',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Sucre',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Tovar',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'urdaneta',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('municipios')->insert([
            'nombre' => 'Zamora',
            'id_estado' => '1',
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
