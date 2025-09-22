<?php

namespace App\Http\Requests\Funcionario;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lp' => 'required|string|max:255|unique:funcionarios,lp',
            'usuario_id' => 'required|exists:users,id',
            'jerarquia_id' => 'required|exists:jerarquias,id',
        ];
    }

    public function messages()
    {
        return [
            'lp.required' => 'El número de legajo es obligatorio.',
            'usuario_id.exists' => 'El usuario seleccionado no existe.',
            'jerarquia_id.exists' => 'La jerarquía no es válida.',
        ];
    }
}
