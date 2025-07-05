<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{   
#estatus del usuario
    const Activo = 1;
    const Inactivo = 2;
    const Suspendido = 3;
#confirmacion del usuario
    const sinConfirmar = 1;
    const confirmado = 2;
    
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'fechanacimiento',
        'email',
        'password',
        'cedula',
        'telefono',
        'whatsapp',
        'id_role',
        'id_municipio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'cedula',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        return $this->attributes['password'] = bcrypt($value);
        
    }

    #relacion inversa uno a uno entre user y municipio
    public function municipio(){
        return $this->belongsTo(Municipio::class,'id_municipio','id');
    }
    #relacion uno a uno entre user y proforma
    public function proforma(){
        return $this->hasMany(Proforma::class,'id_user','id');
    }

    #relacion uno a uno entre user y rol
    public function role(){
        return $this->belongsTo(Role::class,'id_role','id');
    }
    #relacion uno a uno entre user y hotel
    public function hotel()
    {
        return $this->hasMany(Hotel::class, 'id_user', 'id');
    }
    #relacion uno a uno entre user y hotel
    public function paquete(){
        return $this->hasMany(Hotel::class, 'id_user', 'id');
    }


    #relacion uno a uno entre user y destacado
    public function destacado(){
        return $this->hasMany(Destacado::class, 'id_user', 'id');
    }
    
    #relacion uno a uno entre user y auditoria
    public function auditoria(){
        return $this->hasMany(Auditoria::class, 'id_user', 'id');
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'id_user', 'id');
    }

}
