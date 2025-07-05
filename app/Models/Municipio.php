<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Municipio extends Model
{
    use HasFactory;

    #relacion  inversa uno a muchos entre estado y municipio
    public function estado(){
        return $this->belongsTo(Estado::class,'id_estado','id');
    }
#relacion uno a uno entre user y municipio
    public function user(){
        return $this->hasMany(User::class,'id_municipio','id');
    }
}
