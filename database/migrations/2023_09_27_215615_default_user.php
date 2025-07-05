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
        DB::table('users')->insert([
            'nombre'=>'kervin',
            'apellido'=>'licett',
            'email' => 'kervin@gmail.com',
            'password'=>bcrypt('Admin@123'),
            'cedula' => '17800980',
            'confirmacion' => '2',
            'id_role'=>'1',
            'id_municipio'=>'6',
            'created_at' => $fecha
        ]);

        DB::table('users')->insert([
            'nombre'=>'cristian',
            'apellido'=>'gerig',
            'email' => 'chriscodetech@gmail.com',
            'password'=>bcrypt('Admin@123'),
            'cedula' => '31317165',
            'confirmacion' => '2',
            'id_role'=>'1',
            'id_municipio'=>'6',
            'created_at' => $fecha
        ]);

        DB::table('users')->insert([
            'nombre'=>'adonai',
            'apellido'=>'la riva',
            'email' => 'adonai@gmail.com',
            'password'=>bcrypt('Admin@123'),
            'cedula' => '30091249',
            'confirmacion' => '2',
            'id_role'=>'1',
            'id_municipio'=>'6',
            'created_at' => $fecha
        ]);

        DB::table('users')->insert([
            'nombre'=>'estefany',
            'apellido'=>'gutiérrez',
            'email' => 'estefany@gmail.com',
            'password'=>bcrypt('Admin@123'),
            'cedula' => '27521333 ',
            'confirmacion' => '2',
            'id_role'=>'3',
            'id_municipio'=>'6',
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