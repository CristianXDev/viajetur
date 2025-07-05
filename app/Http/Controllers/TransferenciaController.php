<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Destino;
use App\Models\Paquete;

use App\Models\Proforma;

use Carbon\Carbon;

class TransferenciaController extends Controller{


    public function payment(Request $request){

        //Recuperar el id del request
        $packageID = $request['id'];

        //Buscar el paquete por su ID
        $paquete = Paquete::find($packageID);

        return view('payment.transferencia',compact('paquete','packageID'));
    }


    public function pay(Request $request){

        //Reservar paquete
        $reserva = new Proforma();
        $reserva->referencia = uniqid();
        $reserva->fecha_pago = Carbon::now();
        $reserva->fecha_reserva = Carbon::now();
        $reserva->id_user = Auth()->user()->id;
        $reserva->id_paquete = $request->id; // ID del paquete
        $reserva->metodo_pago = 'Transferencia Bancaria'; // ID del proveedor
        $reserva->ref_transferencia= $request->referencia;
        $reserva->estatus = 2; // Estatus del pago
        $reserva->save();

        return redirect('/dashboard/mis_reservas')->with('success','Paquete comprado');
    }
}
