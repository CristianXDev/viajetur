<?php

namespace App\Http\Controllers;

use App\Models\Comida;
use App\Models\Destino;
use App\Models\Hotel;
use App\Models\TipoPaquete;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function formPaquete(){
       $destinos = Destino::all();
       return view('dashboard.paquete.filtro.form1', compact('destinos'));
    }

    public function filtrarhotel(Request $request){
        $destino = Destino::where('id',$request->id_destino)->first();
        $hoteles = Hotel::where('id_destino', $request->id_destino)->where('estado',Hotel::Activo)->get();
        return view('dashboard.paquete.filtro.form2', compact('hoteles','destino'));
    }

    public function filtrarAgregados(Request $request){
        $destino = Destino::where('id',$request->id_destino)->first();
        $hotel = Hotel::where('id',$request->id_hotel)->first();
        if (isset($hotel)) {
            
        }else{
            
        }
        

        $capacidad = 0;
        return view('dashboard.paquete.filtro.form3', compact('hotel','destino','es', 'capacidad', 'tipoPaquetes'));
    }

    public function confirmar(Request $request){
        $precio = 0;

        $destino = Destino::where('id',$request->id_destino)->first();
        $hotel = Hotel::where('id',$request->id_hotel)->first();
        
        

 
       return view('dashboard.paquete.filtro.form4', compact('hotel','destino','tipoPaquete','precio','request'));
    }

}
