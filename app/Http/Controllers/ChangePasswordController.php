<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChangePasswordController extends Controller{


    public function index(Request $request){

        $token = $request->query('token');

        $user = User::where('remember_token', $token)->first();

        if(!$user){
            
            return redirect('/forgotPassword')->withErrors('Token invalido');
        }

        return view('auth.change_password');
}

    public function changePassword(Request $request){

        $token = $request->query('token');
        #$token = $request->token;

        $user = User::where('remember_token', $token)->first();

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        if ($user){

            $password = bcrypt($request->password);

             User::where('id',$user->id)->update([

                'remember_token'=>null,
                'password' => $password,

            ]);

            return redirect('/login')->with('success','Contraseña actualizada');
        }

        else{

            return redirect('/forgotPassword')->withErrors('El token es invalido');
        }
    }

}
