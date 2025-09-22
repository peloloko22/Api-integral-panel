<?php

namespace App\Http\Requests\CategoriaDelito;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaDelitoUpdateRequest extends FormRequest
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
            'codigo' => 'required|string|max:255|unique:categoria_delitos,codigo,' . $this->route('categoriaDelito')->id,

        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.string' => 'El código debe ser una cadena de texto.',
            'codigo.unique' => 'El código ya ha sido utilizado.',
        ];
    }
}
