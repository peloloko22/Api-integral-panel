<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HechoRegistro extends FormRequest
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
            

            'tipificacion_id' => 'required|exists:tipificacion_delitos,id',
            'calificacion_id' => 'nullable|exists:calificaciones,id',
            'modus_id' => 'nullable|exists:modus_operandis,id',
            'mecanismo_arma_id' => 'nullable|exists:mecanismo_armas,id',
            'imputado_conocido' => 'required|boolean',
            'imputado_id' => 'nullable|exists:personas,id',
            'tipo_transporte_imputado_id' => 'nullable|exists:tipo_transporte_imputados,id',
            'victima_id' => 'nullable|exists:personas,id',
            'victima_vinculo_id' => 'nullable|exists:vinculo_victimas,id',
            'es_femicidio' => 'required|boolean',
            'violencia_genero_id' => 'required|boolean',
        ];
    }
}
