<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaqueteRequest;
use App\Models\Auditoria;
use App\Models\Destino;
use App\Models\Hotel;
use App\Models\Paquete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1) {
            $paquetes=Paquete::all();
        }elseif (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1 && Auth()->user()->role->bloquear == 0) {
            $paquetes=Paquete::where('id_user',Auth()->user()->id)->orderByDesc('vistas')->get();
        }else{
            $activo = Paquete::Activo;
            $paquetes=Paquete::where('estado',$activo)->where('bloqueado',$activo)->orderByDesc('vistas')->get();
        }
        return view('dashboard.carta-paquetes', compact('paquetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1 && Auth()->user()->status == 1){


            $activo = Hotel::Activo;
            $hoteles=Hotel::where('id_user',Auth()->user()->id)->where('estado',$activo)->where('bloqueado',$activo)->orderByDesc('vistas')->get();
            $destinos = Destino::orderByDesc('vistas')->get();
            return view('dashboard.paquete.create', compact('hoteles','destinos'));

        }else {
            /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de crear paquetes sin los permisos adecuados';
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
    public function store(PaqueteRequest $request){
        $fecha = Carbon::now();
        $fechaActual = $fecha->toDateString();
        $request['created_at'] = $fechaActual;
        
        $validator =Validator::make($request->all(),[
            'nombre'=>'unique:paquetes,nombre',
            
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validator =Validator::make($request->all(),[
            'foto'=> 'required|image'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->noches != $request->dias && ($request->dias - 1) > $request->noches || ($request->dias + 1) < $request->noches) {
            $validator ='Las noches no coinsiden con los dias';        
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }


       if(isset($request->id_hotel) && hotel::where('id',$request->id_hotel)->where('id_destino',$request->id_destino)->exists() == false){
        $validator ='El hotel no coinsiden con el destino';        
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $paquete = $request->except('_token', 'precio');
    $paquete['id_user'] = Auth()->user()->id;

    if ($request->hasFile('foto')){
        $paquete['foto']=$request->file('foto')->store('upload','public');
    }


    $paquete['nombre'] = strtolower($request['nombre']);
    if (isset($request->id_hotel)) {
        $hotel=Hotel::where('id',$request->id_hotel)->first();
        $paquete['precio'] = $request->precio + $hotel['precio'];
    }else{
        $paquete['precio'] = $request->precio;
    }

    Paquete::insert($paquete);
    /*----------------registro de auditorias--------------------------------------*/
    $auditoria['id_user'] = Auth()->user()->id;
    $auditoria['descripcion'] = 'El usuario agrego un nuevo paquete con el nombre de '. $paquete['nombre'];
    $fecha = Carbon::now();
    $auditoria['created_at'] = $fecha;
    Auditoria::insert($auditoria);
    /*-----------------------------------------------------------------------------*/
    return redirect()->route('paquete.index')->with('success', '¡Paquete creado!');
}

    /**
     * Display the specified resource.
     */
    public function show($id){
        $paquete = Paquete::where('id',$id)->first();
        $vistas=$paquete->vistas;
        $paquete->vistas = $vistas+1;
        $paquete->update();
        return view('dashboard.paquete.show', compact('paquete'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paquete = Paquete::where('id',$id)->first();
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $paquete->user->id && Auth()->user()->status == 1){
            $hoteles=Hotel::where('id_user',Auth()->user()->id)->where('id_destino',Auth()->user()->id)->orderByDesc('vistas')->get();
            return view('dashboard.paquete.edit', compact('paquete', 'hoteles'));
        }else {
            /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de editar paquetes sin los permisos adecuados';
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
    public function update(PaqueteRequest $request, $id){
        if (Paquete::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {

            $validator =Validator::make($request->all(),[
                'nombre'=>'unique:paquetes,nombre'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

       $newPaquete = Request()->except(['_token', '_method', 'foto']);
       $oldPaquete= Paquete::where('id',$id)->first();
       if ($request->hasFile('foto')) {
        Storage::delete(['Public/'.$oldPaquete->foto]);
        $newPaquete['foto']= $request->file('foto')->store('upload', 'public');
    }

    $newPaquete['nombre'] = strtolower($request['nombre']);

    Paquete::where('id',$id)->update($newPaquete);
    /*----------------registro de auditorias--------------------------------------*/
    $auditoria['id_user'] = Auth()->user()->id;
    $auditoria['descripcion'] = 'El usuario edito el paquete '.$oldPaquete['nombre']." a ". $request->nombre;
    $fecha = Carbon::now();
    $auditoria['created_at'] = $fecha;
    Auditoria::insert($auditoria);
    /*-----------------------------------------------------------------------------*/
    return redirect()->route('paquete.index')->with('success',$oldPaquete->nombre.' fue actualizado a '.$request->nombre);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
      if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->borrar == 1){
        $paquete=Paquete::find($id);
        if ($paquete->proforma->count() == 0) {
            if (isset($paquete->foto)) {
                Storage::delete(['Public/'.$paquete->foto]);  
            }
            foreach ($paquete->fotoPaquete as $foto) {
                if (isset($foto->foto)) {
                    Storage::delete(['Public/'.$foto->foto]);  
                }
            }
            /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario borro el paquete de '. $paquete['nombre'];
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $paquete->delete();
            return redirect()->route('paquete.index')->with('success','Fue elimanado el paquete') ;
        }
    }else {
        /*----------------registro de auditorias--------------------------------------*/
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario intento borrar un paquete sin los permisos adecuados';
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        $validator ='El usuario no cuenta con el permiso para esta accion';        
        return redirect()->back()->withErrors($validator)->withInput();
    }
}

public function bloquear(Request $request, $id){
    if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1 && Auth()->user()->status == 1) {

        $paquete = Paquete::where('id',$id)->first();
        if($request->status == 1 && isset($paquete->hotel)){
            if ($paquete->hotel->bloqueado == 2){
                $validator ='El usuario no puede desbloquear el paquete si el hotel se encuentra bloqueado';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $paquete->bloqueado = $request->status;
        $paquete->update();
        if($request->status == 1){
            $status = 'desbloqueado';
        }else {
            $status = 'bloqueado';
        }
        /*----------------registro de auditorias--------------------------------------*/
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario a '.$status .' el Paquete '. $paquete->nombre;
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->back()->with('success', 'El paquete a sido '.$status.' en el sistema');
    }else {
        /*----------------registro de auditorias--------------------------------------*/
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de bloquear paquetes sin los permisos adecuados';
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        $validator ='el usuario no cuenta con el permiso para esta accion';        
        return redirect()->back()->withErrors($validator)->withInput();
    }
}

}
