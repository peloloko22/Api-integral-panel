<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Denuncia extends FormRequest
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
            'tipo_denuncia_id' => Rule::exists('tipo_denuncias', 'id'),
            'tipificacion_delito_id' => Rule::exists('tipificacion_delitos', 'id'),
            'fiscal_id' => Rule::exists('fiscales', 'id'),
            'funcionario_interviniente' => 'required|string|max:255',
            'victima_id' => Rule::exists('personas', 'id'),
            'denunciante_id' => Rule::exists('personas', 'id'),
            'fecha_hecho' => 'required|date',
            'fecha_denuncia' => 'required|date',
            'dependencia_id' => Rule::exists('dependencias', 'id'),
            'relato' => 'required|string',
            'registrada_en_estadisticas' => 'nullable|boolean',
        ];
    }
}
