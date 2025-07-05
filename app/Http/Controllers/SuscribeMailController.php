<?php

namespace App\Http\Controllers;

use App\Models\SuscribeMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuscribeMailController extends Controller{

    public function suscribe(Request $request){

        $validatedData = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('suscribe_mails', 'email'),
            ],
        // otros campos validados aquí...
        ]);
        $mail = $request['email'];


        $usuario = new SuscribeMail();
        $usuario->email = $mail;
        $usuario->save();

        return redirect('/')->with('success', 'Correo electrónico guardado correctamente');
    }
}
