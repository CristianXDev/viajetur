<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\FotoHotel;
use App\Models\FotoPaquete;
use App\Models\Hotel;
use App\Models\Paquete;
use App\Models\videoHotel;
use App\Models\videoPaquete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function agregarFotoHotel(Request $request)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $validator =Validator::make($request->all(),[
                'foto' => 'required|image',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $fotoHotel = request()->except(['_token','id_user']);
            if ($request->hasFile('foto')){
                $fotoHotel['foto'] = $request->file('foto')->store('upload','public');
            }
            $fecha = Carbon::now();
            $fotoHotel['created_at'] = $fecha;
            FotoHotel::insert($fotoHotel);
            /*----------------registro de auditorias--------------------------------------*/
            $hotel= Hotel::where('id',$request->id_hotel)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario agrego una nueva foto para el hotel '.$hotel->nombre;
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'Se agrego una nueva foto al hotel'.$hotel->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de agregar fotos para un hotel sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function borrarFotoHotel(Request $request, $id)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $foto = FotoHotel::find($id);
            if (isset($foto->foto)) {
                Storage::delete(['Public/'.$foto->foto]);
            }
            $foto->delete();
            /*----------------registro de auditorias--------------------------------------*/
                $hotel= Hotel::where('id',$request->id_hotel)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario borro una foto del hotel '.$hotel->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'Se borro una foto del hotel'.$hotel->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de borrar fotos para un hotel sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    
    

    public function agregarFotoPaquete(Request $request)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $validator =Validator::make($request->all(),[
                'foto' => 'required|image',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();

            }
            $fotoPaquete = request()->except(['_token','id_user']);
            if ($request->hasFile('foto')){
                $fotoPaquete['foto'] = $request->file('foto')->store('upload','public');
            }
            $fecha = Carbon::now();
            $fotoPaquete['created_at'] = $fecha;
            FotoPaquete::insert($fotoPaquete);
            /*----------------registro de auditorias--------------------------------------*/
            $paquete= Paquete::where('id',$request->id_paquete)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario agrego una nueva foto al paquete '.$paquete->nombre;
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'Se agrego una nueva foto al paquete '.$paquete->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de agregar fotos para un paquete sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function borrarFotoPaquete(Request $request, $id)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $foto = FotoPaquete::find($id);
            if (isset($foto->foto)) {
                Storage::delete(['Public/'.$foto->foto]);
            }
            /*----------------registro de auditorias--------------------------------------*/
                $paquete= Paquete::where('id',$request->id_paquete)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario borro una foto del paquete '.$paquete->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $foto->delete();
            return redirect()->back()->with('success', 'Se borro una foto del paquete '.$paquete->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de borrar fotos para un paquete sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }


    public function agregarVideoHotel(Request $request)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $validator =Validator::make($request->all(),[
                'video' => 'required|file|mimes:mp4|max: 100000',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $videoHotel = request()->except(['_token','id_user']);
            if ($request->hasFile('video')){
                $videoHotel['video'] = $request->file('video')->store('upload','public');
            }
            $fecha = Carbon::now();
            $videoHotel['created_at'] = $fecha;
            videoHotel::insert($videoHotel);
            /*----------------registro de auditorias--------------------------------------*/
            $hotel= Hotel::where('id',$request->id_hotel)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario agrego un nuevo video a la galeria del '.$hotel->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'Se agrego un nuevo video a la galeria del '.$hotel->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de agregar video para un hotel sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function borrarVideoHotel(Request $request, $id)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $video = videoHotel::find($id);
            if (isset($video->video)) {
                Storage::delete(['Public/'.$video->video]);
            }
            /*----------------registro de auditorias--------------------------------------*/
                $hotel= Hotel::where('id',$request->id_hotel)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario borro un video del hotel '.$hotel->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $video->delete();
            return redirect()->back()->with('success', 'Se borro un video del hotel'.$hotel->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de borrar video para un hotel sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function agregarVideoPaquete(Request $request)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $validator =Validator::make($request->all(),[
                'video' => 'required|file|mimes:mp4,avi,flv|max: 100000',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $videoPaquete = request()->except(['_token','id_user']);
            if ($request->hasFile('video')){
                $videoPaquete['video'] = $request->file('video')->store('upload','public');
            }
            $fecha = Carbon::now();
            $videoPaquete['created_at'] = $fecha;
            videoPaquete::insert($videoPaquete);
            /*----------------registro de auditorias--------------------------------------*/
                $paquete= Paquete::where('id',$request->id_paquete)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario agrego una nueva foto al paquete '.$paquete->nombre;
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return redirect()->back()->with('success', 'Se agrego una nueva foto al paquete '.$paquete->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de agregar fotos para un paquete sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function borrarVideoPaquete(Request $request, $id)
    {
        if (Auth()->user()->role->administrar_servicios == 1 && Auth()->user()->role->editar == 1 && Auth()->user()->id == $request->id_user && Auth()->user()->status == 1){
            $foto = videoPaquete::find($id);
            if (isset($foto->foto)) {
                Storage::delete(['Public/'.$foto->foto]);
            }
            /*----------------registro de auditorias--------------------------------------*/
                $paquete= Paquete::where('id',$request->id_paquete)->first();
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario borro una foto del paquete '.$paquete->nombre;
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $foto->delete();
            return redirect()->back()->with('success', 'Se borro una foto del paquete '.$paquete->nombre);
        }else {
            /*----------------registro de auditorias--------------------------------------*/
                $auditoria['id_user'] = Auth()->user()->id;
                $auditoria['descripcion'] = 'El usuario intento acceder a la ruta de borrar fotos para un paquete sin los permisos adecuados';
                $fecha = Carbon::now();
                $auditoria['created_at'] = $fecha;
                Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            $validator ='El usuario no cuenta con el permiso para esta accion';        
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

}
