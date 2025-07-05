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
        DB::table('destinos')->insert([
            'foto' => 'upload/chuao.jpg',
            'nombre' => 'Chuao',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('destinos')->insert([
            'foto' => 'upload/cata.jpg',
            'nombre' => 'Cata',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('destinos')->insert([
            'foto' => 'upload/maracay.jpeg',
            'nombre' => 'Maracay',
            'id_estado' => '1',
            'created_at' => $fecha
        ]);

        DB::table('destinos')->insert([
            'foto' => 'upload/ocumare.jpg',            
            'nombre' => 'Ocumare de la Costa de Oro',
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
