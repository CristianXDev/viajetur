<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout(){
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario cerro su sesion';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        #hacer que fluya el ciclo de sesiones
        Session::flush();
        #cerrar sesion
        Auth::logout();
        #redirigir al login
        return redirect('/');
    }
}
