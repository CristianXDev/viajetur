<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destacado extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function paquete(){
        return $this->belongsTo(paquete::class, 'id_paquete', 'id');
    }
}
