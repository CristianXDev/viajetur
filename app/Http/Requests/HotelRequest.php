<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules(): array
    {
        return [
            'nombre'=>'required',
            'foto' => 'nullable|image',
            'descripcion'=>'required|min:10|max:255',
            'correo'=>'required|email',
            'telefono'=>'nullable|regex:/^(?=.*?[0-9])/|regex:/^(?=.*?[-]*$)/|not_regex:/^(?=.*?[a-zA-Z!@#$%^&+*,{}[]?":<>])/',
            'whatsapp'=>'nullable|regex:/^(?=.*?[0-9])/|regex:/^(?=.*?[+])/|regex:/^(?=.*?[-]*$)/|not_regex:/^(?=.*?[a-zA-Z!@#$%^&*,{}[]?":<>])/',
            'id_destino' => 'required',
            'precio' => 'required|numeric|min:1',
            
        ];
    }
}
