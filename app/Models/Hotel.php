<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
#constante para definir el estado de los hoteles
    const Activo = 1;
    const Inactivo = 2;
    const Bloqueado = 2;


#relacion inversa uno a muchos entre estado y Hotel
    public function destino(){
        return $this->belongsTo(Destino::class, 'id_destino','id');
    }



    public function paquetes(){
        return $this->hasMany(Paquete::class, 'id_hotel', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function fotoHotel()
    {
        return $this->hasMany(FotoHotel::class, 'id_hotel', 'id');
    }

    public function videoHotel()
    {
        return $this->hasMany(videoHotel::class, 'id_hotel', 'id');
    }
}
