<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Proveedor;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_usuarios == 1) {
            $users = User::all();
            $roles = Role::all();
            return view('dashboard.usuario.index', compact('users', 'roles'));
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if ($request['telefono'] != Null ) {
            
    #saber si el numero de telefon tiene un guion "-" para proporcionarlo
            if (strlen($request->telefono) == 11 && strpos($request->telefono,'-') == false) {
                $request['telefono'] = substr($request->telefono,0,4).'-'.substr($request->telefono,4,7);
            }

    #identificar si el numero de telefon no es valido
            if ((strlen($request->telefono) != 12 || substr($request->telefono,4,1) !='-') || substr_count($request->telefono,'-') > 1) {
                $errors['telefono'] ='El telefono no es valido.';
            }

    #verificar si existe un telefono con los cambios realizados
            if (User::where('telefono',$request->telefono)->exists() == false) {
                $confirmed['telefono'] = $request->telefono;
            }else {
                $errors['telefono'] = 'El telefono ya esta registrado.';
            }
            
        }
        
    #saber si el ususario tiene whatsapp
        if ($request['whatsapp'] != Null ) {
    #saber si el numero de watsapp tiene un guion "-" para proporcionarlo
            if (strlen($request->whatsapp) == 10 && strpos($request->whatsapp,'-') == false) {
                $request['whatsapp'] = substr($request->whatsapp,0,3).'-'.substr($request->whatsapp,3,7);
                
            }

    #identificar si el numero de whatsapp no es valido
            if (strlen($request->whatsapp) != 11 || substr($request->whatsapp,3,1) != '-' || substr_count($request->whatsapp,'-') > 1 || substr($request->whatsapp,0,1) == '0') {
                $errors['whatsapp'] = 'El whatsapp no es valido.';
            }

    #verificar si existe un whatsapp con los cambios realizados
            if (User::where('whatsapp','%'.$request->whatsapp)->exists() == false) {
                $confirmed['whatsapp'] = $request->extencion." ".$request->whatsapp;
            }else {
                $errors['whatsapp'] = 'El whatsapp ya esta registrado.';
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bloquear(Request $request, $id){
        if (Auth()->user()->role->administrar_usuarios == 1 && Auth()->user()->role->bloquear == 1) {
            if ( Auth()->user()->id != $id){
                $user = User::where('id',$id)->first();
                $user->status = $request->status;
                $user->update();
                if($request->status == 1){
                    $status = 'desbloqueado';
                }else {
                    $status = 'bloqueado';
                }
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario a '.$status .' el usuario '. $user->email;
                    $fecha = Carbon::now();
                    $auditoria['created_at'] = $fecha;
                    Auditoria::insert($auditoria);
                /*-----------------------------------------------------------------------------*/
                return redirect()->back()->with('success', 'Usuario a sido '.$status.' en el sistema');
            } else {
                $validator = "El usuario no puede bloquearse el mismo";
            return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de bloquear usuarios sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function cambiarRole(Request $request, $id){
        if (Auth()->user()->role->administrar_usuarios == 1 && Auth()->user()->role->editar == 1) {
            if ( Auth()->user()->id != $id){
                $user = User::where('id',$id)->first();
                $newRole = Role::where('id',$request->rol)->first();
                if ((isset($user->proveedor) && $newRole->id == 4) || $newRole->id != 4) {
                    $oldRole = $user->role->nombre;
                    $user->id_role = $request->rol;
                    $user->update();
                    if(isset($user->proveedor) && $user->proveedor->solicitud == 1){
                        $proveedor = Proveedor::where('id', $user->proveedor->id)->first();
                        $proveedor->solicitud = 2;
                        $proveedor->update();
                    }
                }else {
                    return redirect()->back()->withErrors('El usuario no posee el requisitos del rif para ser proveedor')->withInput();  
                }
                /*----------------registro de auditorias--------------------------------------*/
                    $auditoria['id_user'] = Auth()->user()->id;
                    $auditoria['descripcion'] = 'El usuario cambio el rol de '.$oldRole .' a '. $newRole->nombre.' del usuario '.$user->email;
                    $fecha = Carbon::now();
                    $auditoria['created_at'] = $fecha;
                    Auditoria::insert($auditoria);
                    
                /*-----------------------------------------------------------------------------*/
                return redirect()->back()->with('success', 'Usuario a sido '.$newRole->nombre.' en el sistema');
            } else {
                $validator = "El usuario no puede bloquearse el mismo";
            return redirect()->back()->withErrors($validator)->withInput();
            }
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de cambio de roles sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    public function solicitud(Request $request){
        $user = User::where('id',$request->id_user)->first();
        if ($request->solicitud == 1) {
            $user->id_role = 4;
            $user->update();
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'Proceso la solicitud del ususario';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
        }
        $proveedor = Proveedor::where('id', $user->proveedor->id)->first();
        $proveedor->solicitud = 2;
        $proveedor->update();
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'Proceso la solicitud del ususario';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect()->back()->with('success', 'Solicitud procesada');
    }
}
