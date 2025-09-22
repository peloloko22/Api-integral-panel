<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('usuario')->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'dni' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'domicilio' => 'nullable|string|max:255',
            'sexo'=> 'required|exists:sexos,id'
        ];
    }
}
