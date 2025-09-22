<?php

namespace App\Http\Requests\Sexo;

use Illuminate\Foundation\Http\FormRequest;

class SexoStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255|unique:sexos,nombre',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
