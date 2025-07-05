<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * autoriza si las regals se cumplen en los campos
     */

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    /**#################################################################################################################
    verifica los datos del usuario que cuenten con los parametros correctos de seguridad y requerimiento:
    #####################################################################################################################
    reglas->required = se rrequiere obligatoriamente este campo
    reglas->unique:user,"nombre del campo" = este campo de be ser unico para cada usuario 
    reglas->min"N°"= cantidad minima de caracteres para un campo
    reglas->regex = verifica que el campo tenga almenos uno de los caracteres especificados
    reglas->regex/^(?=.*?[A-Z])/ = verifica que tenga mayusculas entre A y Z
    reglas->regex/^(?=.*?[a-z])/ = verifica que tenga minusculas entre a y z
    reglas->regex/^(?=.*?[0-9])/ = verifica que tenga numeros entre 0 y 9
    reglas->regex/^(?=.*?[!@#$%^&*,.?":<>])/ = verifica que tenga uno de los caracteres especificados entre los corchetes
    reglas->same:"nombre del campo" = verifica que sea igual al campo nombrado
    ######################################################################################################################*/
    public function rules(): array
    {
        
        return [
            #'usuario'=>'required|unique:users,usuario|min:3',
            'cedula'=>'required|unique:users,cedula|regex:/^(?=.*?[0-9])/|regex:/^(?=.*?[.]*$)/|not_regex:/^(?=.*?[a-zA-Z!@#$%^&+*,{}[]?":<>-])/',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:8|regex:/^(?=.*?[A-Z0-9!@#$%^&*,.?":<>])/',
            'password_confirmation'=>'required|same:password',
            #'id_municipio'=>'required',
        ];
    }
}
