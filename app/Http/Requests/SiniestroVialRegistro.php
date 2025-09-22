<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiniestroVialRegistro extends FormRequest
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
            "tipo_siniestro_id" => [
                'required',
                'exists:tipo_siniestros,id',
            ],
            "fuga" => [
                'required',
                'boolean',
            ],
            "alcohol" => [
                'required',
                'boolean',
            ],
            "tipo_lugar_siniestro_vial_id" => [
                'required',
                'exists:tipo_lugar_siniestro_vial,id',
            ],
            "semaforo_siniestro_id" => [
                'required',
                'exists:semaforo_siniestros,id',
            ],
            "condicion_climatica_id" => [
                'required',
                'exists:condicion_climaticas,id',
            ],
            "participantes" => [
                'required',
                'array',
            ],
            "participantes.*.persona_id" => [
                'required',
                'exists:personas,id',
            ],
            "participantes.*.vehiculo_id" => [
                'required',
                'exists:vehiculos,id',
            ],
            "participantes.*.rol_siniestro_id" => [
                'required',
                'exists:rol_siniestros,id',
            ],
            "participantes.*.fallecido" => [
                'required',
                'boolean',
            ],
        ];
    }
}
