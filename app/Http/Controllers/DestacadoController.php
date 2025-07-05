<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\User;
use App\Models\Destacado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DestacadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('dashboard.carta-destacados');
    }


    public function destacar(Request $request, $id_paquete)
    {
        $destacado = Request()->except(['_method','_token']);
        if (Destacado::where('id_user', $destacado['id_user'])->where('id_paquete',$destacado['id_paquete'])->exists() == false) {
            Destacado::insert($destacado);

        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario agrego un paquete a la lista de destacados';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*----------------------------------------------------------------------------*/

            return redirect()->back()->with('success', 'El paquete a sido destacado con exito');
        } else {
            $seleccion = Destacado::where('id_user', $destacado['id_user'])->where('id_paquete',$destacado['id_paquete']);
            $seleccion->delete();

            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario quito un paquete de la lista de destacados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*----------------------------------------------------------------------------*/

            return redirect()->back()->with('success', 'El paquete a dejado de ser destacado');
        }
        
    }
}
