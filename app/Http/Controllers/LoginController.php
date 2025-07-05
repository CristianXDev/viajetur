<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Auditoria;
use App\Models\Rol;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show(){
        #autentificar si  existe un usuario logeado para redirigir al dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        return view('auth.login');
    }
    public function login(LoginRequest $request){

        $condicion = 'email';
    
        #comprobar si exixte un usuario en la plataforma
        if (User::where($condicion, strtolower($request->usuario))->exists() != false) {
            $comparacion = User::where($condicion, strtolower($request->usuario))->first();
            
  
            #comprovar si el usuario y el correo coinciden
            if ($comparacion->$condicion == strtolower($request->usuario)) {

                #comprovar la contarseña y el correo son del mismo usuario
                if ($comparacion->$condicion == strtolower($request->usuario) && Hash::check($request->password, $comparacion->password)) {
                    #comprovar la contarseña y el correo son del mismo usuario y saber si esta confirmado
                    if($comparacion->$condicion == strtolower($request->usuario) && Hash::check($request->password, $comparacion->password) && $comparacion->confirmacion == User::confirmado){
                        #comprovar la contarseña y el correo son del mismo usuario, saber si esta confirmado y saber su estatus 
                        if ($comparacion->$condicion == strtolower($request->usuario) && Hash::check($request->password, $comparacion->password) && $comparacion->confirmacion == User::confirmado && $comparacion->status == User::Activo) {
                            $credentials = $request->getCredentials();
                                #por ultimo hace una validacion extra para las credenciales en caso de que esten mal
                                if (!Auth::validate($credentials)) {
                                #redirigir nuevamente al login con el error
                                return redirect('/login')->withErrors('credenciales invalidas');
                                }
                                #cuando esten validadas y logear las credenciales
                                $user = Auth::getProvider()->retrieveByCredentials($credentials);

                                Auth::login($user);

                                #redirigir a la funcion
                                return $this->authenticated($request, $user);
                        }elseif($comparacion->status == User::Suspendido){
                            $error='Sentimos informarle que su usuario a sido suspendido temporalmente';
                        }else {
                            $error='Sentimos informarle que su usuario a sido blequeado de esta plataforma';
                        }
                    }else{
                        $error='Este usuario no a confirmado su cuenta';
                    }
                }else{
                    $error='Alguno de sus datos no coincide';
                }
                
            }else{
                $error='Alguno de sus datos no coincide';
            }
        }else{
            return redirect('/login')->withErrors('El correo no existe');
        } 
        return redirect('/login')->withErrors($error);
    }
#---------------------------------------------------------------------------------------------------------

    #redireccion al dashboard
    public function authenticated(Request $request, $user){
        /*----------------registro de auditorias--------------------------------------*/
            $auditoria['id_user'] = Auth()->user()->id;
            $auditoria['descripcion'] = 'El usuario intento inicio session';
            $fecha = Carbon::now();
            $auditoria['created_at'] = $fecha;
            Auditoria::insert($auditoria);
        /*-----------------------------------------------------------------------------*/
        return redirect('/dashboard');
    }
}
