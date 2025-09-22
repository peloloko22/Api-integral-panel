<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'dni' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'domicilio' => 'nullable|string|max:255',
            'sexo_id' => 'required|exists:sexos,id',

            'roles' => 'array|required',
            'roles.*' => 'exists:roles,id',

            'funcionario.jerarquia_id' => 'nullable|exists:jerarquias,id',
            'funcionario.lp' => 'nullable|string',



        ];
    }
}
