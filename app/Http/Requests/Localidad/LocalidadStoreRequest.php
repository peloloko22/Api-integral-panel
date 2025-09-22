<?php

namespace App\Http\Requests\Localidad;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:10|unique:localidades,codigo',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'nullable|exists:municipios,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'departamento_id.required' => 'El departamento es obligatorio.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',
            'municipio_id.exists' => 'El municipio seleccionado no es válido.',
        ];
    }
}
