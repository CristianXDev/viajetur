<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    const Admin = 1;
    const Activo = 1;
    const Inactivo = 0;

#relacion uno a uno entre user y rol
    public function user(){
        return $this->hasMany(User::class,'id_role','id');
    }

}
