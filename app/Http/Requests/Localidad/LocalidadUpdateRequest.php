<?php

namespace App\Http\Requests\Localidad;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:10|unique:localidades,codigo,' . $this->route('localidad')->id,
            'municipio_id' => 'required|exists:municipios,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'municipio_id.exists' => 'El municipio seleccionado no es válido.',
        ];
    }
}
