<?php

namespace App\Http\Requests\TipoNovedad;

use Illuminate\Foundation\Http\FormRequest;

class TipoNovedadStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'nombre' => 'required|string|max:255',
            'prioridad' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:7', // Formato hexadecimal, por ejemplo: #FFFFFF
            'tipo_alerta_id' => 'nullable|exists:tipo_alertas,id', // Asegura que el ID exista en la tabla tipo_alertas
        ];
    }

    public function messages()
    {

        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'prioridad.integer' => 'La prioridad debe ser un número entero.',
            'prioridad.min' => 'La prioridad debe ser al menos 0.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no puede exceder los 7 caracteres (formato hexadecimal).',
            'tipo_alerta_id.exists' => 'El tipo de alerta seleccionado no existe.',

        ];
    }
}
