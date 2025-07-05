<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
#relacion uno a muchos entre destino y Hotel
    public function hotel(){
        return $this->hasMany(Hotel::class,'id_destino','id');
    }

#relacion inversa de uno a muchos entre estado y destino
    public function estado(){
       return $this->belongsTo(Estado::class,'id_estado','id');
    }
#relacion uno a muchos entre destino y paquete
    public function paquete(){
        return $this->hasMany(Paquete::class,'id_destino','id');
    }
}
