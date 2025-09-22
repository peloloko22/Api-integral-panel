<?php

namespace App\Http\Requests\Municipio;

use Illuminate\Foundation\Http\FormRequest;

class TipoVehiculoNovedadUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }
}
