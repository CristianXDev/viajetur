<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Auditoria;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

    class RoleController extends Controller
    {
        
        /**
         * Display a listing of the resource.
         */
        # code...

        public function index()
        {
            if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1) {
                $roles=Role::all();
                return view('dashboard.rol.index', compact('roles'));
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
            if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->agregar == 1) {
                return view('dashboard.rol.create');
            }else {
                $this->auditoriaSinPermiso('crear');
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
                'nombre'=>'required|unique:roles,nombre'
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors('El nombre ya existe')->withInput();
            }

            $role['nombre'] = $request->nombre;
            
            /*if($request->reservar == true){
                $role['reservar'] = 1;
            }*/

            if($request->agregar == true){
                $role['agregar'] = 1;
            }

            if($request->editar == true){
                $role['editar'] = 1;
            }

            if($request->borrar == true){
                $role['borrar'] = 1;
            }

            if($request->bloquear == true){
                $role['bloquear'] = 1;
            }

            if($request->administrar_usuarios == true){
                $role['administrar_usuarios'] = 1;
            }

            if($request->administrar_pagos == true){
                $role['administrar_pagos'] = 1;
            }

            if($request->administrar_roles == true){
                $role['administrar_roles'] = 1;
            }

            if($request->administrar_estados == true){
                $role['administrar_estados'] = 1;
            }

            if($request->administrar_destinos == true){
                $role['administrar_destinos'] = 1;
            }

            if($request->administrar_municipios == true){
                $role['administrar_municipios'] = 1;
            }

            Role::insert($role);
            $this->auditoria('agrego', $request->nombre);
            return redirect()->route('role.index')->with('success', 'Rol creado');
        }

        /**
         * Display the specified resource.
         */
        public function show(role $role)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit($id)
        {
            if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->editar == 1) {
                $role = Role::where('id',$id)->first();
                return view('dashboard.rol.edit', compact('role'));
            }else {
                $this->auditoriaSinPermiso('editar');
                $validator ='El usuario no cuenta con el permiso para esta ruta';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id)
        {
            if (Role::where('id',$id)->where('nombre',$request->nombre)->exists() == false) {
            
                $validator =Validator::make($request->all(),[
                    'nombre'=>'nullable|unique:roles,nombre'
                ]);
    
                if($validator->fails()){
                    return redirect()->back()->withErrors('el nombre ya existe')->withInput();
                }
            }
            $newRole['nombre'] = $request->nombre;
            $oldRole= Role::where('id',$id)->first();
            /*
            if($request->reservar == true){
                $newRole['reservar'] = 1;
            }else{
                $newRole['reservar'] = 0;
            }
            */
            if($id != 1){
                if($request->agregar == true){
                    $newRole['agregar'] = 1;
                }else{
                    $newRole['agregar'] = 0;
                }

                if($request->editar == true){
                    $newRole['editar'] = 1;
                }else{
                    $newRole['editar'] = 0;
                }

                if($request->borrar == true){
                    $newRole['borrar'] = 1;
                }else{
                    $newRole['borrar'] = 0;
                }

                if($request->bloquear == true){
                    $newRole['bloquear'] = 1;
                }else{
                    $newRole['bloquear'] = 0;
                }
            }

            if($request->administrar_usuarios == true){
                $newRole['administrar_usuarios'] = 1;
            }else{
                $newRole['administrar_usuarios'] = 0;
            }

            if($request->administrar_pagos == true){
                $newRole['administrar_pagos'] = 1;
            }else{
                $newRole['administrar_pagos'] = 0;
            }

            if($request->administrar_roles == true){
                $newRole['administrar_roles'] = 1;
            }else{
                $newRole['administrar_roles'] = 0;
            }

            if($request->administrar_estados == true){
                $newRole['administrar_estados'] = 1;
            }else{
                $newRole['administrar_estados'] = 0;
            }

            if($request->administrar_destinos == true){
                $newRole['administrar_destinos'] = 1;
            }else{
                $newRole['administrar_destinos'] = 0;
            }

            if($request->administrar_municipios == true){
                $newRole['administrar_municipios'] = 1;
            }else{
                $newRole['administrar_municipios'] = 0;
            }
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario edito el rol '.$oldRole['nombre']." a ". $request->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
            
            Role::where('id',$id)->update($newRole);
            return redirect()->route('role.index')->with('success',$oldRole->nombre.' fue actualizado a '.$request->nombre);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id)
        {
            if (Auth()->user()->role->id != 4 && Auth()->user()->role->administrar_roles == 1 && Auth()->user()->role->borrar == 1) {
                $role=Role::find($id);
                if ($role->id != 1 && $role->id != 2 && $role->id != 3 && $role->id != 4 && $role->user->count() == 0) {
                    $role->delete();
                    $this->auditoria('borro',$role['nombre']);
                    return redirect()->route('role.index')->withErrors('errors','Fue eliminado el estado') ;
                }else {
                    $validator ='El rol no cumple con los requisitos para ser eliminado';        
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }else {
                $this->auditoriaSinPermiso('borrar');
                $validator ='El usuario no cuenta con el permiso para esta ruta';        
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
        }

        private function auditoria($nombreRuta,$rolName){
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario '.$nombreRuta.' el rol '.$rolName;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
        }
        private function auditoriaSinPermiso($nombreRuta){
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de '.$nombreRuta.' Roles sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
        }

}

