<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paquete;
use App\Models\Destino;

class FindPackageController extends Controller{

//Find Package
    public function find(Request $request){

        $destino = $request['destino']; 
        $capacidad = $request['capacidad']; 
        $rangoMin = $request['precioMin']; 
        $rangoMax = $request['precioMax'];

        $request->validate([
            'precioMin' => 'required|numeric|min:0',
            'precioMax' => 'required|numeric|min:'.$request->precioMin
        ]);

        $package = Paquete::query();

        if(!empty($destino)){

            $package->where('id_destino', $destino);
        }

        if(!empty($capacidad) && $capacidad > 0 && $capacidad < 11){

            $package->where('capacidad', $capacidad);
        }

        if (!empty($rangoMin) && !empty($rangoMax)) {

            $package->whereBetween('precio', [$rangoMin, $rangoMax]);
        }

        $paquetes =  $package->get();


        return view('home.find-packages',compact('paquetes'));
    }

    public function destinate_find($id){

        $destino = $id; 

        $package = Paquete::query();

        if(!empty($destino)){

            $package->where('id_destino', $destino);
        }

        $paquetes =  $package->get();

        $result = Destino::find($id);
        
        //Cantidad de vistas
        $vistas=$result->vistas;
        $result->vistas = $vistas+1;
        $result->update(); 

        return view('home.find-packages',compact('paquetes'));

    }
}