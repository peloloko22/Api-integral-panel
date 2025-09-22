<?php

namespace App\Http\Requests\FormularioAyuda;

use Illuminate\Foundation\Http\FormRequest;

class FormularioAyudaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'tipo_formulario_ayuda_id' => 'required|exists:tipo_formulario_ayudas,id',
            'usuario_id' => 'required|exists:users,id',

        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no puede exceder los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
            'tipo_formulario_ayuda_id.required' => 'El tipo de formulario de ayuda es obligatorio.',
            'tipo_formulario_ayuda_id.exists' => 'El tipo de formulario de ayuda seleccionado no es válido.',
            'usuario_id.required' => 'El usuario es obligatorio.',
            'usuario_id.exists' => 'El usuario seleccionado no es válido.',

        ];
    }
}
