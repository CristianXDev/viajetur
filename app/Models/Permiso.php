<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    public function rol(){
       return $this->belongsTo(Role::class,'id_role','id');
    }
    static public function permisosUser($value) {
        $permisos = Permiso::where('id_role',$value);
        return $permisos;
    } 
}
