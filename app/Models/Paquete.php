<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;
#constante para definir el estado de los paquetes
    const Disponible = 1;
    const NoDisponible = 2;
#constante para definir el estado de los paquetes
    const Activo = 1;
    const Bloqueado = 2;
#relacion inversa de uno a muchos entre paquetes y hotel
    public function hotel(){
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id');
    }

#relacion inversa de uno a muchos entre destino y paquete
    public function destino(){
        return $this->BelongsTo(Destino::class, 'id_destino', 'id');
    }
#relacion inversa de uno a muchos entre destino y paquete
    public function proforma(){
        return $this->hasMany(Proforma::class, 'id_paquete', 'id');
    }

    #relacion inversa de uno a muchos entre user y paquete
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function destacado(){
        return $this->hasMany(Destacado::class, 'id_paquete', 'id');
    }

    public function fotoPaquete()
    {
        return $this->hasMany(FotoPaquete::class, 'id_paquete', 'id');
    }

    public function videoPaquete()
    {
        return $this->hasMany(videoPaquete::class, 'id_paquete', 'id');
    }
}
