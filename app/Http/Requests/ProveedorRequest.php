<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'rif'=>'unique:proveedors,rif|regex:/^(?=.*?[0-9])/|regex:/^(?=.*?[V]*$)/|not_regex:/^(?=.*?[a-zA-Z!@#$%^&+*,.{}[]?":<>])/|size:10'
        ];
    }
}
