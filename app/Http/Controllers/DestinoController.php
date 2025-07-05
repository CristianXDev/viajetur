<?php

namespace App\Http\Controllers;
use App\Http\Requests\DestinoRequest;
use App\Models\Auditoria;
use App\Models\Destino;
use App\Models\Estado;
use App\Models\Paquete;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $destinos=Destino::orderByDesc('vistas')->get();
        return view('dashboard.table-destino', compact('destinos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        if(Auth()->user()->role->administrar_destinos == 1 && Auth()->user()->role->agregar == 1){
            $estados = Estado::all();
            return view('dashboard.destino.create', compact('estados'));
        }else {
        $validator ='El usuario no cuenta con el permiso para esta accion';  
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de crear destinos sin los permisos adecuados';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/      
        return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinoRequest $request){

        $validator =Validator::make($request->all(),[
            'nombre'=>'unique:destinos,nombre'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('El nombre ya existe')->withInput();
        }

        $destino = $request->except('_token');
        if ($request->hasFile('foto')){
            $destino['foto']=$request->file('foto')->store('upload','public');
        }

        $destino['created_at'] =  Carbon::now(); 

        Destino::insert($destino);

        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario agrego un nuevo destino con el nombre de '. $destino['nombre'];
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('destino.index')->with('success', '¡Destino creado!');

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id){
        $destino = Destino::where('id',$id)->first();
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario vio el destinos con el nombre: '. $destino->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        $vistas=$destino->vistas;
        $destino->vistas = $vistas+1;
        $destino->update();
        return redirect()->back()->with('success', 'visto');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id){
        if(Auth()->user()->role->administrar_destinos == 1 && Auth()->user()->role->editar == 1 ){
            $destino = Destino::where('id',$id)->first();
            return view('dashboard.destino.edit', compact('destino'));
        }else {
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de editar destinos sin los permisos adecuados';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/      
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        if (Destino::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {
            
            $validator =Validator::make($request->all(),[
                'nombre'=>'unique:destinos,nombre'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors('El nombre ya existe')->withInput();
            }
        }
        $validator =Validator::make($request->all(),[
            'foto'=> 'nullable|image'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('El nombre ya existe')->withInput();
        }
        $newDestino = Request()->except(['_token', '_method',]);
        $oldDestino = Destino::where('id',$id)->first();
        if ($request->hasFile('foto')) {
            Storage::delete(['Public/'.$oldDestino->foto]);
            $newDestino['foto']= $request->file('foto')->store('upload', 'public');
        }
        Destino::where('id',$id)->update($newDestino);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario edito el destino '.$oldDestino['nombre']." a ". $request->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/      
        return redirect()->route('destino.index')->with('success',$oldDestino->nombre.' fue actualizado a '.$request->nombre);
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth()->user()->role->administrar_destinos == 1 && Auth()->user()->role->borrar == 1){
            $destino=Destino::find($id);
            if ($destino->paquete->count() == 0 && $destino->hotel->count() == 0) {
                if (isset($destino->foto) && $destino->foto != 'upload/ocumare.jpg'  && $destino->foto != 'upload/chuao.jpg'  && $destino->foto != 'upload/maracay.jpeg'  && $destino->foto != 'upload/cata.jpg') {
                    Storage::delete(['Public/'.$destino->foto]);
                }
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario borro el destino '. $destino['nombre'];
                    $fecha = Carbon::now();
                    $auditoria['created_at'] = $fecha;
                    Auditoria::insert($auditoria);
                /*-----------------------------------------------------------------------------*/ 
                $destino->delete();
                return redirect()->route('destino.index')->withErrors('errors','¡Fue elimanado el destino!') ;
            }else {
                return redirect()->route('destino.index')->withErrors('errors','¡No puede ser eliminado!') ;
            }
        }else {

            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento borrar un destino sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/ 

            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function card(){
        $destinos=Destino::orderByDesc('vistas')->get();
        return view('dashboard.cardDestino', compact('destinos'));
    }
}
