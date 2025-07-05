<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Estado;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

use App\Mail\ConfirmedMailMaileable;
use App\Models\Auditoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\map;

class RegisterController extends Controller
{
#--------funcion para mostrar la vista de registro---------#
   public function Show(){
    if ( Auth::check()) {
        return redirect('/dashboard');
    }
    
    $estados = Estado::all();
    return view('auth.register', compact('estados'));
    }
#----------------------------------------------------------#
#-------funcion para registrar a un usuario----------------#
    public function register(RegisterRequest $request){
    /*---------------------------------------------------------------------------------------------
    -"$confirmed" sera la nueva variable donde se almacenaran los datos corregidos para el usuario-
    -donde seran convertidos a minuscula y los datos de la cedula arreglados de tal forma que     -
    -los datos sean
    ---------------------------------------------------------------------------------------------*/
    #convertir a minusculas los datos personales del usuario
        $confirmed['nombre'] = strtolower($request->nombre);
        $confirmed['apellido'] = strtolower($request->apellido);
        #$confirmed['usuario'] = strtolower($request->usuario);
        $confirmed['email'] = strtolower($request->email);
        $confirmed['password'] = $request->password;

        
    #verificar si los datos de la cedula contiene puntos o su formatos es el carrecto
        if ((strlen($request->cedula) == 10 && substr($request->cedula,2,1) == '.' && substr($request->cedula,6,1) == '.' && substr_count($request->cedula,'.') == 2)|| (strlen($request->cedula)==8 && strpos($request->cedula,'.') == false)){
            $request['cedula'] = str_replace('.','',$request->cedula);

    #verificar si existe una cedula con los cambios realizados
            if (User::where('cedula',$request->cedula)->exists() == false) {
                $confirmed['cedula'] =$request->cedula;
            }else {
                $errors['cedula'] = 'La cedula ya esta registrada.';
            }  
        }else{
            $errors['cedula'] = 'El formato de la cedula es invalido.';
        }
       
    #saber si el usuario tiene un telefono
        if ($request['telefono'] != Null ) {
            
    #saber si el numero de telefon tiene un guion "-" para proporcionarlo
            if (strlen($request->telefono) == 11 && strpos($request->telefono,'-') == false) {
                $request['telefono'] = substr($request->telefono,0,4).'-'.substr($request->telefono,4,7);
            }

    #identificar si el numero de telefon no es valido
            if ((strlen($request->telefono) != 12 || substr($request->telefono,4,1) !='-') || substr_count($request->telefono,'-') > 1) {
                $errors['telefono'] ='El telefono no es valido.';
            }

    #verificar si existe un telefono con los cambios realizados
            if (User::where('telefono',$request->telefono)->exists() == false) {
                $confirmed['telefono'] = $request->telefono;
            }else {
                $errors['telefono'] = 'El telefono ya esta registrado.';
            }
            
        }
    

        if(!empty($errors)) {
            return redirect('/register')->withErrors($errors);
        }

    #busca el rol que vendra por defecto para cada usuario ingresado
        $rol = Role::where('id', '3')->first();
        $confirmed['id_role'] = $rol->id;
            
    #validar los datos ingresados para el registro  
        $user = User::create($confirmed);

    #Enviar correo electroncio de confirmación al usuario

        #Generar token
        $token = Str::random(60);

        #Actualizar 
        User::where('email',$request->email)->update(['email_verification_token'=>$token]);

        #Arreglo de datos para pasarselo a la vista del correo
         $datos = [
            'nombre' => $request->nombre,
            'token'=> $token,
        ];

        Mail::to($request->email)->send(new ConfirmedMailMaileable($datos));

        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario se registro';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        #redirigir al login con un mensaje
        return redirect('/login')->With('success', 'Registro satisfactorio');
    }
#----------------------------------------------------------#
}
