<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\Destino;
use App\Models\Hotel;
use App\Models\Paquete;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackageController extends Controller{


    public function show($package, $id){

        //Datos de los paquetes
        $libre = Paquete::Disponible;

        //Buscar el paquete por su ID
        $paquete = Paquete::find($id);
        #$paquetes = Paquete::where('estado', $libre)->orderByDesc('vistas')->take(3)->get();

        //Quitar guiones del nombre de los paquetes
        $packageName = str_replace('-', ' ', $package);

        // Validar si el nombre y el ID coinciden con algún paquete
        if ($paquete && $paquete->nombre == $packageName && $paquete->id == $id){

        // El nombre y ID coinciden con un paquete existente en la base de datos
        // Hacer algo con el paquete encontrado

        //Cantidad de vistas
            $vistas=$paquete->vistas;
            $paquete->vistas = $vistas+1;
            $paquete->update(); 
            /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario vio el paquete con el nombre de '. $paquete->nombre;
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
            /*-----------------------------------------------------------------------------*/
            return view('dashboard.paquete.show.dashboard-package', compact('paquete','packageName'));
        }

        else { // No se encontró ningún paquete con el nombre e ID especificados

         return redirect('/dashboard')->withErrors('El paquete no es valido');
     }
 }

 public function show_hotel($hotel, $id){

    //Buscar el paquete por su ID
    $hotel = Hotel::find($id);

    //Quitar guiones del nombre de los paquetes
    $hotelName = str_replace('-', ' ', $hotel);



        // El nombre y ID coinciden con un paquete existente en la base de datos
        // Hacer algo con el paquete encontrado

        //Cantidad de vistas
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
        return view('dashboard.hotel.show.dashboard-hotel', compact('hotel','hotelName'));

 }
}
