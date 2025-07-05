<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Destino;
use App\Models\Paquete;
use App\Models\Hotel;
use App\Models\Proforma;
use App\Models\Proforma_hotel;

use Carbon\Carbon;

class PaymentController extends Controller{


    public function proforma($package, $id){

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

            return view('payment.proforma', compact('paquete','packageName'));
        }

        else { // No se encontró ningún paquete con el nombre e ID especificados

           return redirect('/dashboard')->withErrors('El paquete no es valido');
       }


   }

   public function proforma_hotel($hotel, $id){

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

    return view('payment.proforma_hotel', compact('hotel','hotelName'));

}

public function payment(Request $request, $package, $id){

        //Buscar el paquete por su ID
    $paquete = Paquete::find($id);

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

        return view('payment.proforma', compact('paquete','packageName'));
    }

        else { // No se encontró ningún paquete con el nombre e ID especificados

           return redirect('/dashboard')->withErrors('El paquete no es valido');
       }

   }


   public function pay(Request $request){

    $packageID = $request['id'];

    $paquete = Paquete::find($packageID);

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'), // ClientSecret
            )
    );

        // After Step 2
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal($paquete->precio);
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls->setReturnUrl(route('approved', ['id' => $paquete->id, 'p' => $request->personas]))
    ->setCancelUrl(route('dashboard-package-payment',[Str::slug($paquete->nombre),$paquete->id]));

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

        // After Step 3
    try{

        $payment->create($apiContext);

        return redirect()->away($payment->getApprovalLink());
    }

    catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        echo $ex->getData();
    }

    return 'Ha ocurrido un problema con la conexión';

}

public function pay_hotel(Request $request){

    $hotelID = $request['id'];

    $hotel = Paquete::find($hotelID);

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'), // ClientSecret
            )
    );

        // After Step 2
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal($hotel->precio);
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls->setReturnUrl(route('approved_hotel', ['id' => $hotel->id, 'p' => $request->personas]))
    ->setCancelUrl(route('cardHoteles',[Str::slug($hotel->nombre),$hotel->id]));

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

        // After Step 3
    try{

        $payment->create($apiContext);

        return redirect()->away($payment->getApprovalLink());
    }

    catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        echo $ex->getData();
    }

    return 'Ha ocurrido un problema con la conexión';

}


public function approved(Request $request){

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'),      // ClientSecret
            )
    );

    $paymentId = $_GET['paymentId'];
    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

    $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    $result = $payment->execute($execution, $apiContext);

    $id = $request->id;
    $p = $request->p;

    //Reservar paquete
    $reserva = new Proforma();
    $reserva->referencia = uniqid();
    $reserva->fecha_pago = Carbon::now();
    $reserva->fecha_reserva = Carbon::now();
    $reserva->id_user = Auth()->user()->id;
        $reserva->id_paquete = $id; // ID del paquete
        $reserva->metodo_pago = 'Paypal'; // Procesador de pago
        $reserva->estatus = 1; // Estatus del pago
        $reserva->personas = $p; // Cantidd de personas
        $reserva->save();
        $paquete = Paquete::where('id',$id)->first();

        $reserva = Paquete::where('id', $id)->increment('reservas');
        /*----------------registro de auditorias--------------------------------------*/
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario reservo el paquete con nombre de '. $paquete->nombre;
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect('/dashboard/mis_reservas')->with('success','Paquete comprado');
    }

    public function approved_hotel(Request $request){

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'),      // ClientSecret
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $result = $payment->execute($execution, $apiContext);

        $id = $request->id;
        $p = $request->p;

    //Reservar paquete
        $reserva = new Proforma_hotel();
        $reserva->referencia = uniqid();
        $reserva->fecha_pago = Carbon::now();
        $reserva->fecha_reserva = Carbon::now();
        $reserva->id_user = Auth()->user()->id;
        $reserva->id_hotel = $id; // ID del paquete
        $reserva->metodo_pago = 'Paypal'; // Procesador de pago
        $reserva->estatus = 1; // Estatus del pago
        $reserva->personas = $p; // Cantidd de personas
        $reserva->save();
        $hotel = Proforma_hotel::where('id',$id)->first();

        $reserva = Paquete::where('id', $id)->increment('reservas');
        /*----------------registro de auditorias--------------------------------------*/
        $auditoria['id_user'] = Auth()->user()->id;
        $auditoria['descripcion'] = 'El usuario reservo el hotel con nombre de '. $hotel->nombre;
        $fecha = Carbon::now();
        $auditoria['created_at'] = $fecha;
        Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect('dashboard/mis_reservas/hoteles')->with('success','Hotel comprado');
    }

}
