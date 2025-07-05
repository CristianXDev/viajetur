<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Estado;
use App\Models\Municipio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_municipios == 1) {
            $municipios=Municipio::all();
            return view('dashboard.municipio.index', compact('municipios'));
        }else {
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_municipios == 1 && Auth()->user()->role->agregar == 1) {
            $estados = Estado::all();
            return view('dashboard.municipio.create', compact('estados'));
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de crear municipios sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/ 
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'nombre'=>'required|unique:municipios,nombre',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('El nombre ya existe')->withInput();
        }

        $validator =Validator::make($request->all(),[
            'id_estado' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('El campo del estado esta vacio')->withInput();
        }
        $municipio = $request->except('_token');
        Municipio::insert($municipio);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario agrego un nuevo municipio con el nombre de '. $municipio['nombre'];
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('municipio.index')->with('success', 'Municipio creado');
    }

   
    public function edit($id)
    {
        
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_municipios == 1 && Auth()->user()->role->editar == 1) {
            $municipio = Municipio::where('id',$id)->first();
            return view('dashboard.municipio.edit', compact('municipio'));
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de editar municipios sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Municipio::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {
            
            $validator =Validator::make($request->all(),[
                'nombre'=>'required|unique:municipios,nombre'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors('El nombre ya existe')->withInput();
            }
        }
        $newmunicipio = Request()->except(['_token', '_method']);
        $oldmunicipio= Municipio::where('id',$id)->first();
        Municipio::where('id',$id)->update($newmunicipio);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario edito el municipio '. $oldmunicipio->nombre ." a ". $request->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('municipio.index')->with('success', $oldmunicipio->nombre.' fue actualizado a '.$request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->borrar == 1) {
            $municipio=Municipio::find($id);
            if ($municipio->user->count() == 0) {
                $municipio->delete();
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario borro el municipio de '. $municipio['nombre'];
                    $fecha = Carbon::now();
                    $auditoria['created_at'] = $fecha;
                    Auditoria::insert($auditoria);
                /*-----------------------------------------------------------------------------*/ 
                return redirect()->route('municipio.index')->withErrors('errors','Fue elimanado el municipio');
            }else {
                $validator ='El municipio no cumple con los requisitos para ser eliminado';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento borrar un municipio sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/ 
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
