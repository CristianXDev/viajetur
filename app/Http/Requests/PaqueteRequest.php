<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaqueteRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:30',
            'foto' => 'nullable|image',
            'dias' => 'required|numeric|min:1',
            'noches' => 'required|numeric|min:0',
            'descripcion' => 'required',
            'capacidad' => 'required|numeric|min:1',
            'id_destino' => 'required',
            'id_hotel' => 'nullable',
            'precio' => 'required|numeric|min:1',
        ];
    }
}
