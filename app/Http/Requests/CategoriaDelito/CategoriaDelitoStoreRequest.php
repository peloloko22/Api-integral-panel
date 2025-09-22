<?php

namespace App\Http\Requests\CategoriaDelito;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaDelitoStoreRequest extends FormRequest
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
            'codigo_snic' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria_delitos', 'codigo_snic')->ignore($this->route('categoria_delito')->id ?? null),
            ],
                'codigo_sat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria_delitos', 'codigo_sat')->ignore($this->route('categoria_delito')->id ?? null),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'codigo_snic.required' => 'El código SNIC es obligatorio.',
            'codigo_snic.string' => 'El código SNIC debe ser una cadena de texto.',
            'codigo_snic.unique' => 'El código SNIC ya ha sido utilizado.',
            'codigo_sat.required' => 'El código SAT es obligatorio.',
            'codigo_sat.string' => 'El código SAT debe ser una cadena de texto.',
            'codigo_sat.unique' => 'El código SAT ya ha sido utilizado.',

        ];

    }
}
