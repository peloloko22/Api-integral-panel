<?php

namespace App\Http\Requests\Departamental;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentalStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:departamentales,codigo',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya está en uso.',
        ];
    }
}
