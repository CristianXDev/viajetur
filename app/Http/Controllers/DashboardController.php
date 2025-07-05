<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;
use App\Models\Paquete;
use Carbon\Carbon;

class DashboardController extends Controller{

    public function index(){

      $paquetesPopularesMes = Paquete::whereMonth('created_at', now()->month)
      ->orderByDesc('vistas')
      ->take(6)
      ->get();

      $paquetesVendidossMes = Paquete::whereMonth('created_at', now()->month)
      ->orderByDesc('reservas')
      ->take(6)
      ->get();


      return view('dashboard.stats',compact('paquetesPopularesMes','paquetesVendidossMes'));

  }


}
