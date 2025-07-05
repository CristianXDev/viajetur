<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadoRequest;
use App\Models\Auditoria;
use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1) {
            $estados=Estado::all();
            return view('dashboard.estado.index', compact('estados'));
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
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->editar == 1) {
            return view('dashboard.estado.create');
        }else {
             /*----------------registro de auditorias--------------------------------------*/
             $auditoria['id_user'] = Auth()->user()->id;
             $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de crear estados sin los permisos adecuados';
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
            'nombre'=>'required|unique:estados,nombre'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('El nombre ya existe')->withInput();
        }
        $estado = $request->except('_token');
        Estado::insert($estado);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario agrego un nuevo estado con el nombre de '. $estado['nombre'];
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('estado.index')->with('success', 'Destino creado');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit($id)
    {
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->editar == 1) {
            $estado = Estado::where('id',$id)->first();
            return view('dashboard.estado.edit', compact('estado'));
        }else {
            /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de editar estado sin los permisos adecuados';
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
        if (Estado::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {
            
            $validator =Validator::make($request->all(),[
                'nombre'=>'required|unique:estados,nombre'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors('El nombre ya existe')->withInput();
            }
        }
        $newEstado = Request()->except(['_token', '_method']);
        $oldEstado= Estado::where('id',$id)->first();
        Estado::where('id',$id)->update($newEstado);
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario edito el destino '. $oldEstado->nombre." a ". $request->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
        return redirect()->route('estado.index')->with('success', $oldEstado->nombre.' fue actualizado a '.$request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_estados == 1 && Auth()->user()->role->borrar == 1) {
            $estado=Estado::find($id);
        
            if ($estado->municipios->count() == 0 && $estado->destinos->count() == 0) {
                $estado->delete();
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario borro el estado de '. $estado['nombre'];
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/ 
                return redirect()->route('estado.index')->withErrors('errors','Fue elimanado el estado') ;
            }else {
                $validator ='El estado no cumple con los requisitos para ser eliminado';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento borrar un estado sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/ 
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        
        }
    }
}
