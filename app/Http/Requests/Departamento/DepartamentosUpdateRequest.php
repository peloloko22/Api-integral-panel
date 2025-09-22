<?php

namespace App\Http\Requests\Departamento;

use Illuminate\Foundation\Http\FormRequest;



class DepartamentoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            "codigo" => "required|string|max:255|unique:departamentos,codigo," . $this->route('departamento')->id,
            "provincia_id" => "required|integer|exists:provincias,id",
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.string' => 'El código debe ser una cadena de texto.',
            'codigo.unique' => 'El código ya está en uso.',
            'provincia_id.required' => 'La provincia es obligatoria.',
            'provincia_id.integer' => 'La provincia debe ser un número entero.',
        ];
    }
}
