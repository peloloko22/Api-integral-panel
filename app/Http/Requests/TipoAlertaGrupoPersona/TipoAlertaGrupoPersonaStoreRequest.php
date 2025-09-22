<?php

namespace App\Http\Requests\TipoAlertaGrupoPersona;

use Illuminate\Foundation\Http\FormRequest;

class TipoAlertaGrupoPersonaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_alerta_id' => 'required|exists:tipo_alertas,id',
            'grupo_persona_id' => 'required|exists:grupo_personas,id',
        ];
    }

    public function messages()
    {
        return [
            'tipo_alerta_id.required' => 'El ID del tipo de alerta es obligatorio.',
            'tipo_alerta_id.exists' => 'El tipo de alerta seleccionado no existe.',
            'grupo_persona_id.required' => 'El ID del grupo de personas es obligatorio.',
            'grupo_persona_id.exists' => 'El grupo de personas seleccionado no existe.',
        ];
    }
}
