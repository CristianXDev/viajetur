<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorRequest;
use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function agregar(ProveedorRequest $request)
    {
        if (strpos($request->rif,'-') == false) {
            $proveedor = request()->except('_token');
            proveedor::insert($proveedor);
            return redirect()->back()->with('success','Solicitud enviada')->withInput();
        }else {
            return redirect()->back()->withErrors('El RIF no posee el formato correcto')->withInput();
        }
    }
}
