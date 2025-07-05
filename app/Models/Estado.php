<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

#relacion uno a muchos entre estado y municipio
    public function municipios(){
        return $this->hasMany(Municipio::class,'id_estado','id');
    }
    
#relacion uno a muchos entre estado y destinos
    public function destinos(){
        return $this->hasMany(Destino::class,'id_estado','id');
    }
}
