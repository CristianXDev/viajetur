<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditorias = Auditoria::all();
        return view('dashboard.auditorias', compact('auditorias'));
    }

    public function agregar($categoria, $nombre)
    {
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario agrego un nuevo '.$categoria .' con el nombre de '. $nombre;
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
    }

    public function filtrar(Request $request){
        $validator =Validator::make($request->all(),[
            'fecha_inicio'=>'required|date',
            'fecha_fin' => 'required|date',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request['fecha_inicio'] > $request['fecha_fin']) {
            return redirect()->back()->withErrors('la fecha de inicial es mayor a la fecha final')->withInput();
        }
        $auditorias = Auditoria::whereBetween('created_at', [$request['fecha_inicio'], $request['fecha_fin']])->get();
        return view('dashboard.auditorias', compact('auditorias'));
    }

    
}
