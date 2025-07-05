<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Auditoria;
use App\Models\Destino;
use App\Models\Hotel;
use App\Models\Paquete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1) {
            $hoteles=Hotel::all();
        }elseif (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1 && Auth()->user()->role->bloquear == 0) {
            $hoteles=Hotel::where('id_user',Auth()->user()->id)->orderByDesc('vistas')->get();
        }else{
            $activo = Hotel::Activo;
            $hoteles=Hotel::where('estado',$activo)->where('bloqueado',$activo)->orderByDesc('vistas')->get();
        }
        return view('dashboard.table-hotel', compact('hoteles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1) {
            $destinos = Destino::all();
            return view('dashboard.hotel.create', compact('destinos'));
        }else {
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de crear hotel sin los permisos adecuados';
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
    public function store(HotelRequest $request){
        $fecha = Carbon::now();
        $fechaActual = $fecha->toDateString();
        $request['created_at'] = $fechaActual;
        $validator =Validator::make($request->all(),[
            'nombre'=>'unique:hotels,nombre',
            'foto' => 'required|image',
            'correo' => 'unique:hotels,correo',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $hotel = $request->except('_token','telefono','whatsapp');
        $hotel['id_user'] = Auth()->user()->id;
        if ($request['telefono'] != Null ) {
            $telefono=$request->telefono;
            #saber si el numero de telefon tiene un guion "-" para proporcionarlo
                    if (strlen($request->telefono) == 11 && strpos($request->telefono,'-') == false) {
                        $telefono = substr($request->telefono,0,4).'-'.substr($request->telefono,4,7);
                    }
        
            #identificar si el numero de telefon no es valido
                    if (strlen($telefono) != 12 || substr($telefono,4,1) !='-' || substr_count($telefono,'-') > 1) {
                        return redirect()->back()->withErrors('Telefono no valido')->withInput();
                    }
        
            #verificar si existe un telefono con los cambios realizados
                    if (hotel::where('telefono',$telefono)->exists() == false) {
                        $validator =Validator::make($request->all(),[
                            'telefono'=>'unique:hotels,telefono'
                        ]);
            
                        if($validator->fails()){
                            return redirect()->back()->withErrors($validator)->withInput();
                        }
                    }
                $hotel['telefono'] = $telefono;
        }
        
        if (strlen($request->whatsapp) != 3) {  

            if ($request['whatsapp'] != Null ) {
        #saber si el numero de watsapp tiene un guion "-" para proporcionarlo
                
                if (strlen($request->whatsapp) == 13 && strpos($request->whatsapp,'-') == false) {
                    $whatsapp = substr($request->whatsapp,0,6).'-'.substr($request->whatsapp,6,7);  
                } 

        #identificar si el numero de whatsapp no es valido
                if (strlen($whatsapp) != 14|| substr($whatsapp,0,1) != '+' || substr_count($whatsapp,'+') > 1 || substr($whatsapp,6,1) != '-' || substr_count($whatsapp,'-') > 1 || substr($whatsapp,0,1) == '0'){
                    return redirect()->back()->withErrors('Whatsapp no valido')->withInput();
                }
    
        #verificar si existe un whatsapp con los cambios realizados
                if (hotel::where('whatsapp',$whatsapp)->exists() == false) {
                    $validator =Validator::make($request->all(),[
                        'whatsapp'=>'unique:hotels,whatsapp'
                    ]);
        
                    if($validator->fails()){
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                $hotel['whatsapp'] = $whatsapp;
                }
            }
        }

        if ($request->hasFile('foto')){
            $hotel['foto']=$request->file('foto')->store('upload','public');
        }


        Hotel::insert($hotel);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario agrego un nuevo Hotel con el nombre de '. $hotel['nombre'];
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('hotel.index')->with('success', '¡Hotel creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = Hotel::where('id',$id)->first();
        $vistas=$hotel->vistas;
        $hotel->vistas = $vistas+1;
        $hotel->update();
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario vio el hotel con el nombre de '. $hotel->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return view('dashboard.hotel.show.dashboard-hotel', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hotel = Hotel::where('id',$id)->first();
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id) {
            return view('dashboard.hotel.edit', compact('hotel'));
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de editar hoteles sin los permisos adecuados';
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
    public function update(HotelRequest $request, $id){
        if (Hotel::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {
            
            $validator =Validator::make($request->all(),[
                'nombre'=>'unique:hotels,nombre'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        if (Hotel::where('id',$id)->where('correo',$request->correo)->exists() == false) {
            
            $validator =Validator::make($request->all(),[
                'correo'=>'unique:hotels,correo'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        #comnezar a almacenar los datos para la actualizacion de ellos 
        $newHotel = Request()->except(['_token', '_method','whatsapp','telefono']);
        #antiguos datos del elemento para la comparacion del mismo
        $oldHotel= Hotel::where('id',$id)->first();
        if ($request['telefono'] != Null ) {
            $telefono=$request->telefono;
            #saber si el numero de telefon tiene un guion "-" para proporcionarlo
                    if (strlen($request->telefono) == 11 && strpos($request->telefono,'-') == false) {
                        $telefono = substr($request->telefono,0,4).'-'.substr($request->telefono,4,7);
                    }else {
                        $telefono=$request->telefono;
                    }
        
            #identificar si el numero de telefon no es valido
                    if (strlen($telefono) != 12 || substr($telefono,4,1) !='-' || substr_count($telefono,'-') > 1) {
                        return redirect()->back()->withErrors('Telefono no valido')->withInput();
                    }
        
            #verificar si existe un telefono con los cambios realizados
                    if (hotel::where('id',$id)->where('telefono',$telefono)->exists() == false) {
                        $validator =Validator::make($request->all(),[
                            'telefono'=>'unique:hotels,telefono'
                        ]);
            
                        if($validator->fails()){
                            return redirect()->back()->withErrors($validator)->withInput();
                        }
                    }
                $newHotel['telefono'] = $telefono;
        }
        
        if (strlen($request->whatsapp) != 3) {  

            if ($request['whatsapp'] != Null ) {
        #saber si el numero de watsapp tiene un guion "-" para proporcionarlo
                
                if (strlen($request->whatsapp) == 13 && strpos($request->whatsapp,'-') == false) {
                    $whatsapp = substr($request->whatsapp,0,6).'-'.substr($request->whatsapp,6,7);  
                }else {
                    $whatsapp=$request->whatsapp;
                }   

        #identificar si el numero de whatsapp no es valido
                if (strlen($whatsapp) != 14|| substr($whatsapp,0,1) != '+' || substr_count($whatsapp,'+') > 1 || substr($whatsapp,6,1) != '-' || substr_count($whatsapp,'-') > 1 || substr($whatsapp,0,1) == '0'){
                    return redirect()->back()->withErrors('whatsapp no valido')->withInput();
                }
    
        #verificar si existe un whatsapp con los cambios realizados
                if (hotel::where('id',$id)->where('whatsapp',$whatsapp)->exists() == false) {
                    $validator =Validator::make($request->all(),[
                        'whatsapp'=>'unique:hotels,whatsapp'
                    ]);
        
                    if($validator->fails()){
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                $newHotel['whatsapp'] = $whatsapp;
                }
            }
        }

        
        if ($request->hasFile('foto')) {
            Storage::delete(['Public/'.$oldHotel->foto]);
            $newHotel['foto']= $request->file('foto')->store('upload', 'public');
        }

        Hotel::where('id',$id)->update($newHotel);
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario edito el hotel '.$oldHotel['nombre']." a ". $request->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->route('hotel.index')->with('success',$oldHotel->nombre.'fue actualizado a '.$request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel=Hotel::find($id);
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $hotel->user->id) {
            if ($hotel->paquetes->count() == 0) {
                if (isset($hotel->foto)) {
                    Storage::delete(['Public/'.$hotel->foto]);
                }
                foreach ($hotel->fotoHotel as $foto) {
                    if (isset($foto->foto)) {
                        Storage::delete(['Public/'.$foto->foto]);
                    }
                }
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario borro el hotel de '. $hotel['nombre'];
                    $fecha = Carbon::now();
                    $auditoria['created_at'] = $fecha;
                    Auditoria::insert($auditoria);
                /*-----------------------------------------------------------------------------*/ 
                $hotel->delete();
                return redirect()->route('hotel.index')->withErrors('errors','¡Fue elimanado el hotel!') ;
            }else {
                $validator ='El hotel tiene elementos unidos a él';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento borrar un hotel sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta ruta';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }
    public function card(){
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1) {
            $hoteles=Hotel::all();
        }elseif (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->agregar == 1 && Auth()->user()->role->bloquear == 0) {
            $hoteles=Hotel::where('id_user',Auth()->user()->id)->orderByDesc('vistas')->get();
        }else{
            $activo = Hotel::Activo;
            $hoteles=Hotel::where('estado',$activo)->where('bloqueado',$activo)->orderByDesc('vistas')->get();
        }
        return view('dashboard.cardHoteles', compact('hoteles'));
    }

    public function bloquear(Request $request, $id){
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->bloquear == 1) {
            $hotel = Hotel::where('id',$id)->first();
            if($request->status == 1 && isset($hotel->user)){
                if ($hotel->user->status == 2){
                    $validator ='El usuario no puede desbloquear el hotel si el usuario se encuentra bloqueado';        
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            $hotel->bloqueado = $request->status;
            if ($hotel->paquetes->count() > 0){
                foreach ($hotel->paquetes as $paquete) {                        
                    $paquetes = Paquete::where('id',$paquete->id )->first();
                    $paquete->bloqueado = $request->status;
                    $paquete->update();
                }
            }
            $hotel->update();
            if($request->status == 1){
                $status = 'desbloqueado';
            }else {
                $status = 'bloqueado';
            }
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario a '.$status .' el hotel '. $hotel->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'El hotel a sido '.$status.' en el sistema');
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de bloquear hoteles sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    
}
