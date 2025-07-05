<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Paquete;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Function_;

class HomeController extends Controller{

    public function index(){
        $type=0;
        $estado = Paquete::Activo;
        $disponible = Paquete::Disponible;
        $destinos=Destino::orderByDesc('vistas')->take(4)->get();
        $paquetes = Paquete::where('bloqueado',$estado)->where('estado',$disponible)->orderByDesc('vistas')->take(3)->get();
        return view('home.index', compact('destinos','paquetes','type'));
    }

    public function destination(){
        $type=0;
        $estado = Paquete::Activo;
        $disponible = Paquete::Disponible;
        $destinos=Destino::orderByDesc('vistas')->take(4)->get();
        $paquetes = Paquete::where('bloqueado',$estado)->where('estado',$disponible)->orderByDesc('vistas')->take(3)->get();
        return view('home.destination', compact('destinos','paquetes','type'));

        $destinos=Destino::orderByDesc('vistas')->get();
        return view('home.destination');
    }

    public function tour(){
        $estado = Paquete::Activo;
        $disponible = Paquete::Disponible;
        $paquetes = Paquete::where('bloqueado',$estado)->where('estado',$disponible)->orderByDesc('vistas')->get();
        return view('home.tour-packages',compact('paquetes'));
    }

    public function offer(){
        return view('home.package-offer');
    }

    public function service(){
        return view('home.service');
    }

    public function about(){
        return view('home.about');
    }

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



            return view('home.shows.package', compact('paquete','packageName'));
        }

        else { // No se encontró ningún paquete con el nombre e ID especificados

         return redirect('/')->withErrors('El paquete no es valido');
     }
 }
}
