<?php

namespace App\Http\Requests\TipificacionDelito;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TipificacionDelitoUpdateRequest extends FormRequest
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
            "homicidio" => 'required|boolean',
            'codigo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tipificacion_delitos', 'codigo')->ignore($this->tipificacion_delito),
            ]
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
            'codigo.required' => 'El código es obligatorio.',
            'codigo.string' => 'El código debe ser una cadena de texto.',
            'codigo.unique' => 'El código ya ha sido utilizado.',
        ];
    }
}
