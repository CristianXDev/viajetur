<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma_hotel extends Model
{
    use HasFactory;

    public function usuario(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'id_hotel','id');
    }
    #relacion inversa de uno a muchos entre proveedor y paquete
    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id');
    }
}
