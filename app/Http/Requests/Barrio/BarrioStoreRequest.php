<?php

namespace App\Http\Requests\Barrio;

use Illuminate\Foundation\Http\FormRequest;

class BarrioStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:10|unique:barrios,codigo',
            'localidad_id' => 'required|exists:localidades,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'localidad_id.required' => 'El municipio es obligatorio.',
            'localidad_id.exists' => 'El municipio seleccionado no es válido.',
        ];
    }
}
