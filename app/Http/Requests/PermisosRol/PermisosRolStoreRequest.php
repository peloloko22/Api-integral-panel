<?php

namespace App\Http\Requests\PermisosRol;

use Illuminate\Foundation\Http\FormRequest;

class PermisosRolStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'permisos_por_rol' => 'required|array',
            'permisos_por_rol.*.rol_id' => 'required|exists:roles,id',
            'permisos_por_rol.*.permisos' => 'required|array',
            'permisos_por_rol.*.permisos.*' => 'required|exists:permisos,id',
        ];
    }

    public function messages()
    {
        return [
            'permisos_por_rol.required' => 'Los permisos por rol son obligatorios.',
            'permisos_por_rol.*.rol_id.required' => 'El ID del rol es obligatorio.',
            'permisos_por_rol.*.rol_id.exists' => 'El rol seleccionado no existe.',
            'permisos_por_rol.*.permisos.required' => 'Los permisos son obligatorios para cada rol.',
            'permisos_por_rol.*.permisos.*.required' => 'Cada permiso es obligatorio.',
            'permisos_por_rol.*.permisos.*.exists' => 'Uno o más permisos seleccionados no existen.',
        ];
    }
}
