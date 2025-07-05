<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller{


    public function index(){

        return view('dashboard.profile');
    }

    public function edit(){

        return view('dashboard.profile.edit');
    }

    public function update(Request $request){

        #Poner letras en minusculas
        $confirmed['nombre'] = strtolower($request->nombre);
        $confirmed['apellido'] = strtolower($request->apellido);
        $confirmed['email'] = strtolower($request->email);
        $confirmed['telefono'] = $request->telefono;

        #Datos de la Validación de los campos
        $required=[
            'nombre'=>'required|string|min:3',
            'apellido'=>'required|string|min:3',
            'email'=>'required|email',
            'telefono'=>'nullable|regex:/^(?=.*?[0-9])/|regex:/^(?=.*?[-]*$)/|not_regex:/^(?=.*?[a-zA-Z!@#$%^&+*,{}[]?":<>])/',
        ];

        #Hacer la validación
        $request->validate($required);

        #Requerir los datos del usuario actual
        $user = Auth()->user();

        #Guardar datos del usuario
        $user->nombre = $confirmed['nombre'];
        $user->apellido = $confirmed['apellido'];


        #saber si el usuario tiene un telefono
        if ($request->telefono != Null ) {

        #saber si el numero de telefon tiene un guion "-" para proporcionarlo
            if (strlen($request->telefono) == 11 && strpos($request->telefono,'-') == false) {
                $request['telefono'] = substr($request->telefono,0,4).'-'.substr($request->telefono,4,7);
            }

        #identificar si el numero de telefon no es valido
            if ((strlen($request->telefono) != 12 || substr($request->telefono,4,1) !='-') || substr_count($request->telefono,'-') > 1) {
                $errors['telefono'] ='el telefono no es valido.';
            }  

        #verificar si existe un telefono con los cambios realizados

            #Verificar el telefono 
            if($user->telefono == $request->telefono){

                $user->telefono = $request['telefono'];

            }

            else if(User::where('telefono',$request['telefono'])->count()>0){

                return redirect()->route('profile')->withErrors('El telefono ya está en uso');
            }

            $user->telefono = $request['telefono'];

        }


        #Verificar correo electronico    
        if($user->email == $request['email']){

            $user->email = $confirmed['email'];

            $user->save();

            return redirect()->route('profile')->with('success','Perfil actualizado correctamente');
        }

        else if(User::where('email',$request['email'])->count()>0){

            return redirect()->route('profile')->withErrors('El correo electronico ya está en uso');

        }

        $user->email = $confirmed['email'];

        $user->save();

        return redirect()->route('profile')->with('success','Perfil actualizado correctamente');
    }

    public function trash(){

        return view('dashboard.profile.delete');
    }

    public function delete(Request $request){

        $request->validate([
            'password'=>'required|min:8|regex:/^(?=.*?[A-Z0-9!@#$%^&*,.?":<>])/',
            'password_confirmation'=>'required|same:password',
        ]);

        $user = Auth()->user();

        $passwordUser = $request->password;
        $passwordBD = $user->password;

        if(Hash::check($passwordUser,$passwordBD)){

            $user->delete();

            return redirect()->route('login')->with('success, Cuenta eliminada correctamente');
        }

        else{

            return redirect()->route('profile-delete')->withErrors('La contraseña no es correcta');
        }
    }


    public function password(){

       return view('dashboard.profile.password');   
   }


   public function changePassword(Request $request){


       $request->validate([
        'oldpassword'=>'required|min:8|regex:/^(?=.*?[A-Z0-9!@#$%^&*,.?":<>])/',
        'password'=>'required|min:8|regex:/^(?=.*?[A-Z0-9!@#$%^&*,.?":<>])/',
        'password_confirmation'=>'required|same:password',
    ]);

       $user = Auth()->user();

       $oldPassword = $request->oldpassword;
       $passwordBD = $user->password;

       $newPassword = $request->password;

       if(Hash::check($oldPassword,$passwordBD)){

            #$hashPassword = bcrypt($newPassword);

        $user->password = $newPassword;

        $user->save();

        return redirect()->route('profile')->with('success', 'Contraseña actualizada correctamente');
    }

    else{

        return redirect()->route('profile-password')->withErrors('La contraseña no es correcta');
    }



}
public function cambiarFoto(Request $request,$id)
{
    $validator =Validator::make($request->all(),[
        'foto' => 'required|image',
    ]);

    $user = User::where('id',$id)->first();
    if ($request->hasFile('foto')) {
        if (isset($user->foto)) {
            Storage::delete(['Public/'.$user->foto]);
        }
        $foto['foto']= $request->file('foto')->store('upload', 'public');
    }

    else{
        return redirect()->back()->withErrors('No se a seleccionado una foto');
   }

   $user->foto = $foto['foto'];
   $user->save();
   return redirect()->back()->with('success', 'Su foto a sido actualizada');

}
}