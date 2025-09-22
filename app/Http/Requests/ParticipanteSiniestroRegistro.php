<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipanteSiniestroRegistro extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'persona_id' => 'required|exists:personas,id',
            'vehiculo_id' => 'nullable|exists:vehiculos,id',
            'fallecido' => 'required|boolean',
            'rol_siniestro_id' => 'required|exists:rol_siniestros,id',
        ];
    }
}
