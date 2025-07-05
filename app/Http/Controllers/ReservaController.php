<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\Proforma_hotel;
use App\Models\Paquete;
use App\Models\Hotel;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paquete(){

          $userID = auth()->id();

        $proformas=Proforma::where('id_user',$userID)->get();
        return view('dashboard.mis_reservas', compact('proformas'));
    }

    public function hotel(){

        $userID = auth()->id();

        $proformas=Proforma_Hotel::where('id_user',$userID)->get();
        return view('dashboard.mis_reservas_hoteles', compact('proformas'));
    }



}
