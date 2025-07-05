<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoHotel extends Model
{
    use HasFactory;

 
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel', 'id');
    }
}
