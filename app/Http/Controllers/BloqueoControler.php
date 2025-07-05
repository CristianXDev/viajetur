<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BloqueoControler extends Controller
{
    public function usuarios(Request $request, $id){
        $user = User::find($id);

    }

    public function paquetes(Request $request, $id){
        
    }

    public function hoteles(Request $request, $id){
        
    }
}
