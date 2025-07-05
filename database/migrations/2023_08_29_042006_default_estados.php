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
#------------Estados por default-------------------------
    DB::table('estados')->insert([
        'nombre' => 'Aragua',
        'created_at' => $fecha
    ]);

    DB::table('estados')->insert([
        'nombre' => 'Distrito Capital',
        'created_at' => $fecha,
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
