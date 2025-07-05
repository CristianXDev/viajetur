<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MailVerificationController extends Controller{


    public function verificate(Request $request){

         $token = $request->query('token');

         $user = User::where('email_verification_token', $token)->first();

         if($user){

            User::where('id',$user->id)->update([

                'email_verified_at'=>now(),
                'email_verification_token'=>null,
                'confirmacion' => 2,

            ]);

            return redirect('/login')->with('success','Correo verificado satisfactoriamente');

         }

         else{

            return redirect('/login')->withErrors('El token no es valido');
         }

    }





}
