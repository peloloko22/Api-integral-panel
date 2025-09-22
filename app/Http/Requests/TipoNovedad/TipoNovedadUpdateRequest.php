<?php

namespace App\Http\Requests\TipoNovedad;

use Illuminate\Foundation\Http\FormRequest;

class TipoNovedadUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
        ];
    }
}
