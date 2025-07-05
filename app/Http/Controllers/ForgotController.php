<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ForgotMailable;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller{


    public function index(){

        return view('auth.forgot_password');
    }
    
    //Recuperar contraseña
    public function forgot(Request $request){

        //Guardar el correo electronico del usuario
        $email = $request->except('_token');


        //Datos que se van a validar
        $required=[
            'email'=>'required|email|min:3|max:100',
        ];

        //Mensaje de errores
        $message=[
            'email.required'=>'El correo es requerido',
            'email.email'=>'El correo no es valido',
            'email.min'=>'El correo es muy corto',
            'email.max'=>'El correo es muy largo',
        ];

        //Validar los datos
        $this->validate($request,$required,$message);


        //Encontrar usuario
        $user = User::where('email',$email)->first();

        if($user){

            $token = Str::random(60);

            //Subir el token
            User::where('email',$email)->update(['remember_token'=>$token]);            

            //Arreglo de datos para pasarselo a la vista del correo
            $datos = [
                'nombre' => $user->nombre,
                'token'=> $token,
            ];

            //Enviar el correo electronico
            Mail::to($email)->send(new ForgotMailable($datos));

           return redirect('/forgotPassword')->With('success', 'Se ha enviado un correo electronico para restablecer su contraseña');
        }

        else{

            return redirect('/forgotPassword')->withErrors('El correo no esta registrado');
        }
    }

}