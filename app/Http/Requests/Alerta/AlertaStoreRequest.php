<?php

namespace App\Http\Requests\Alerta;

use Illuminate\Foundation\Http\FormRequest;

class AlertaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [

            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'enviada' => 'boolean',
            'fecha_hora_envio' => 'nullable|date',
            'tipo_alerta_id' => 'required|exists:tipo_alertas,id',
            'novedad_id' => 'nullable|exists:novedades,id',
            'enviar_ahora' => 'required|boolean',
        ];
    }
}
