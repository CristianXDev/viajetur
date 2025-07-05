<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Paquete;
use App\Models\Hotel;
use App\Models\Destino;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class EstadisticasController extends Controller{


    public function paquete(){

        //Paquetes mas populares (Diario)
        $paquetesPopularesDiario = Paquete::whereDate('created_at', Carbon::now())
        ->orderByDesc('vistas')
        ->take(7)
        ->get();


        //Paquetes mas populares (Semanal)
        $paquetesPopularesSemanal = Paquete::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Quincenal)
        $paquetesPopularesQuincenal = Paquete::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Mensual)
        $paquetesPopularesMes = Paquete::whereMonth('created_at', now()->month)
        ->orderByDesc('vistas')
        ->take(5)
        ->get();

        //Paquetes mas populares (Anual)
        $paquetesPopularesAnual = Paquete::whereYear('created_at', Carbon::now()->year)
        ->orderByDesc('vistas')
        ->take(7)
        ->get();


        //Paquetes más vendidos (Diario)
        $paquetesVendidosDiario = Paquete::whereDate('created_at', Carbon::now())
        ->orderByDesc('reservas')
        ->take(7)
        ->get();

        //Paquetes más vendidos (Semanal)
        $paquetesVendidosSemanal = Paquete::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderByDesc('reservas')
        ->take(7)
        ->get();

        //Paquetes más vendidos (Quincenal)
        $paquetesVendidosQuincenal = Paquete::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()])
        ->orderByDesc('reservas')
        ->take(7)
        ->get();

        //Paquetes más vendidos (Mensual)
        $paquetesVendidosMes = Paquete::whereMonth('created_at', now()->month)
        ->orderByDesc('reservas')
        ->take(7)
        ->get();

        //Paquetes más vendidos (Anual)
        $paquetesVendidosAnual = Paquete::whereYear('created_at', Carbon::now()->year)
        ->orderByDesc('reservas')
        ->take(7)
        ->get();

        return view('dashboard.estadisticas.package',
            compact('paquetesPopularesMes',
                'paquetesPopularesDiario',
                'paquetesPopularesSemanal',
                'paquetesPopularesQuincenal',
                'paquetesPopularesAnual',
                'paquetesVendidosMes',
                'paquetesVendidosDiario',
                'paquetesVendidosSemanal',
                'paquetesVendidosQuincenal',
                'paquetesVendidosAnual'));
    }


    public function hotel(){

        //Paquetes mas populares (Diario)
        $hotelPopularesDiario = Hotel::whereDate('created_at', Carbon::now())
        ->orderByDesc('vistas')
        ->take(7)
        ->get();


        //Paquetes mas populares (Semanal)
        $hotelPopularesSemanal = Hotel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Quincenal)
        $hotelPopularesQuincenal = Hotel::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Mensual)
        $hotelPopularesMes = Hotel::whereMonth('created_at', now()->month)
        ->orderByDesc('vistas')
        ->take(5)
        ->get();

        //Paquetes mas populares (Anual)
        $hotelPopularesAnual = Hotel::whereYear('created_at', Carbon::now()->year)
        ->orderByDesc('vistas')
        ->take(7)
        ->get();


        return view('dashboard.estadisticas.hotel',
            compact('hotelPopularesDiario',
                'hotelPopularesSemanal',
                'hotelPopularesQuincenal',
                'hotelPopularesMes',
                'hotelPopularesAnual'));
    }


    public function user(){

    //Cantidad de usuarios por rol

        $administadores = User::where('id_role', 1)->count();
        $asistentes = User::where('id_role', 2)->count();
        $clientes = User::where('id_role', 3)->count();
        $proveedores = User::where('id_role', 4)->count();

    //Cantidad de usuarios por statuss

        $UserActivo =  User::where('status', 1)->count();
        $UserInactivo =  User::where('status', 2)->count();
        $UserSuspendido =  User::where('status', 3)->count();

    //Cantidad de usuarios registrados en los ultimos 5 meses

        return view('dashboard.estadisticas.user',compact('administadores','asistentes','clientes','proveedores','UserInactivo','UserSuspendido','UserActivo'));

    }

    public function destino(){


        //Paquetes mas populares (Diario)
        $destinosPopularesDiario = Destino::whereDate('created_at', Carbon::now())
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Semanal)
        $destinosPopularesSemanal = Destino::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Quincenal)
        $destinosPopularesQuincenal = Destino::whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()])
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        //Paquetes mas populares (Mensual)
        $destinosPopularesMes = Destino::whereMonth('created_at', now()->month)
        ->orderByDesc('vistas')
        ->take(5)
        ->get();

        //Paquetes mas populares (Anual)
        $destinosPopularesAnual = Destino::whereYear('created_at', Carbon::now()->year)
        ->orderByDesc('vistas')
        ->take(7)
        ->get();

        return view('dashboard.estadisticas.destinos',
            compact('destinosPopularesMes',
                'destinosPopularesDiario',
                'destinosPopularesSemanal',
                'destinosPopularesQuincenal',
                'destinosPopularesAnual'));
    }

    public function paquete_grafica_fecha(Request $request){

        $validatedData = $request->validate([
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after_or_equal:fecha1',
        ]);

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;

        $fecha1Formateada = Carbon::parse($fecha1)->format('d/m/Y');
        $fecha2Formateada = Carbon::parse($fecha2)->format('d/m/Y');

        $paquetesMasVistos = Paquete::whereBetween('created_at', [$validatedData['fecha1'], $validatedData['fecha2']])
        ->orderBy('vistas', 'desc')
        ->take(7)
        ->get();

        $paquetesMasReservados = Paquete::whereBetween('created_at', [$validatedData['fecha1'], $validatedData['fecha2']])
        ->orderBy('reservas', 'desc')
        ->take(7)
        ->get();

        return view('dashboard.estadisticas.fecha_package',
            compact('paquetesMasVistos',
                'paquetesMasReservados',
                'fecha1Formateada',
                'fecha2Formateada',));

    }


    public function destino_grafica_fecha(Request $request){

        $validatedData = $request->validate([
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after_or_equal:fecha1',
        ]);

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;

        $fecha1Formateada = Carbon::parse($fecha1)->format('d/m/Y');
        $fecha2Formateada = Carbon::parse($fecha2)->format('d/m/Y');

        $destinosMasVistos = Destino::whereBetween('created_at', [$validatedData['fecha1'], $validatedData['fecha2']])
        ->orderBy('vistas', 'desc')
        ->take(7)
        ->get();

        return view('dashboard.estadisticas.fecha_destinos',
            compact('destinosMasVistos',
                'fecha1Formateada',
                'fecha2Formateada',));

    }

    public function hoteles_grafica_fecha(Request $request){

        $validatedData = $request->validate([
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after_or_equal:fecha1',
        ]);

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;

        $fecha1Formateada = Carbon::parse($fecha1)->format('d/m/Y');
        $fecha2Formateada = Carbon::parse($fecha2)->format('d/m/Y');

        $hotelesMasVistos = Hotel::whereBetween('created_at', [$validatedData['fecha1'], $validatedData['fecha2']])
        ->orderBy('vistas', 'desc')
        ->take(7)
        ->get();

        $hotelesMasReservados = Hotel::whereBetween('created_at', [$validatedData['fecha1'], $validatedData['fecha2']])
        ->orderBy('reservas', 'desc')
        ->take(7)
        ->get();


        return view('dashboard.estadisticas.fecha_hotel',
            compact('hotelesMasVistos',
                'hotelesMasReservados',
                'fecha1Formateada',
                'fecha2Formateada',));
    }

}




