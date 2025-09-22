<?php

namespace App\Http\Requests\TipificacionDelito;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipificacionDelitoStoreRequest extends FormRequest
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
            'categoria_delito_id' => 'required|exists:categoria_delitos,id',
            'homicidio' => 'required|boolean',
            'codigo_snic' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tipificacion_delitos', 'codigo_snic')->ignore($this->route('tipificacion_delito')->id ?? null),
            ],
                'codigo_sat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tipificacion_delitos', 'codigo_sat')->ignore($this->route('tipificacion_delito')->id ?? null),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'categoria_delito_id.required' => 'La categoría del delito es obligatoria.',
            'categoria_delito_id.exists' => 'La categoría del delito seleccionada no es válida.',

        ];
    }
}
