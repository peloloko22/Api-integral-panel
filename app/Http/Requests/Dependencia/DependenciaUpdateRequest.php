<?php

namespace App\Http\Requests\Dependencia;

use Illuminate\Foundation\Http\FormRequest;

class DependenciaUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:dependencias,codigo,' . $this->route('dependencia')->id,
            'departamental_id' => 'required|exists:departamentales,id',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'El código ya está en uso.',
            'departamental_id.required' => 'El ID departamental es obligatorio.',
            'departamental_id.exists' => 'El ID departamental no existe.',
        ];
    }
}
