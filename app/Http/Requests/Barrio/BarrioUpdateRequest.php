<?php

namespace App\Http\Requests\Barrio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BarrioUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'localidad_id' => 'required|exists:localidades,id',
            Rule::unique('barrios')->ignore($this->route('barrio')->id ?? null),
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'localidad_id.required' => 'La localidad es obligatoria.',
            'localidad_id.exists' => 'La localidad seleccionada no es válida.',
        ];
    }
}
