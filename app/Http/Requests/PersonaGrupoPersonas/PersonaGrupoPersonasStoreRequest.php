<?php

namespace App\Http\Requests\PersonaGrupoPersonas;

use Illuminate\Foundation\Http\FormRequest;

class PersonaGrupoPersonasStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'persona_id' => 'required|exists:users,id',
            'grupo_persona_id' => 'required|exists:grupo_personas,id',
        ];
    }

    public function messages()
    {
        return [
            'persona_id.required' => 'El ID de la persona es obligatorio.',
            'persona_id.exists' => 'La persona seleccionada no existe.',
            'grupo_persona_id.required' => 'El ID del grupo de personas es obligatorio.',
            'grupo_persona_id.exists' => 'El grupo de personas seleccionado no existe.',
        ];
    }
}
