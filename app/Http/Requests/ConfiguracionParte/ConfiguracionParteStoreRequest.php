<?php

namespace App\Http\Requests\ConfiguracionParte;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionParteStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'hora_inicio' => 'required|date_format:H:i:s',
        ];
    }

    public function messages()
    {
        return [
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'La hora de inicio debe ser una hora válida.',
        ];
    }
}
