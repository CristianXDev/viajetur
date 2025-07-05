<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMideleware
{
    public function handle(Request $request, $role){
        $url = $request->fullUrl();
        if (Auth::check() && Auth()->user()->role->id == $role) {
            return redirect('$url');
        }
        #abort(403,'Acceso no autorizado');
    }
}
