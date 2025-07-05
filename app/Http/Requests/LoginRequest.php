<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    #funcion que autoriza los datos utilizando la funcion "rules" como verificador
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    /* ########################################################
    verficamos que ambos campos tengan informacion
     ##########################################################
    reglas->required = se rrequiere obligatoriamente este campo
    ###########################################################*/
    public function rules(): array
    {
        return [
            'usuario' => 'required',
            'password' => 'required',
        ];
    }
    #verificar las credenciales del usuario
    public function getCredentials(){
    #guarda los datos del campo name_user par verificarlos despues 
        $usuario = $this->get('usuario');

        #verificar si es un correo lo que se envio y hace le acceso a travez de este
        if ($this->isEmail($usuario)) {
            #si los datos del campo name_user corresponden a un correo devuelve los valores de los campos password
           return[
                'email' => $usuario,
                'password' => $this->get('password')
                
           ];
        }
        #de otro modo hace la busqueda de las credenciales del usuario
        return $this->only('usuario', 'password');
    }
    #funcion que verificar si es un correo
    public function isEmail($value){ 
        $factory = $this->container->make(ValidationFactory::class);
    /*este return regresa la respuesta de si es un correo o no
    */
        return !$factory->make(['usuario' => $value], ['usuario' => 'email'])->fails();
    }
}
