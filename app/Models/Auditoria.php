<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    #relacion inversa entre auditoria y usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


}
