<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DenunciaIndexRequest extends FormRequest
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
            // Filtros existentes
            'tipo_denuncia_id' => 'nullable|' . Rule::exists('tipo_denuncias', 'id'),
            'tipificacion_delito_id' => 'nullable|' . Rule::exists('tipificacion_delitos', 'id'),
            'dependencia_id' => 'nullable|' . Rule::exists('dependencias', 'id'),
            'fiscal_id' => 'nullable|' . Rule::exists('fiscales', 'id'),
            'funcionario_interviniente' => 'nullable|string|max:255',
            'victima_id' => 'nullable|' . Rule::exists('personas', 'id'),
            'denunciante_id' => 'nullable|' . Rule::exists('personas', 'id'),
            'fecha_hecho' => 'nullable|date',
            'fecha_denuncia' => 'nullable|date',
            'registrada_en_estadisticas' => 'nullable|boolean',
            
            // Nuevos filtros de rango de fechas
            'fecha_hecho_desde' => 'nullable|date',
            'fecha_hecho_hasta' => 'nullable|date|after_or_equal:fecha_hecho_desde',
            'fecha_denuncia_desde' => 'nullable|date',
            'fecha_denuncia_hasta' => 'nullable|date|after_or_equal:fecha_denuncia_desde',
            
            // Paginación
            'per_page' => 'nullable|integer|min:1|max:100',
            'all' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'fecha_hecho_hasta.after_or_equal' => 'La fecha hasta del hecho debe ser posterior o igual a la fecha desde.',
            'fecha_denuncia_hasta.after_or_equal' => 'La fecha hasta de la denuncia debe ser posterior o igual a la fecha desde.',
        ];
    }
}
