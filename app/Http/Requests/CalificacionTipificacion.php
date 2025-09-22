<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificacionTipificacion extends FormRequest
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
            'calificaciones_ids' => [
                'nullable',
                'array',
            ],
            'calificaciones_ids.*' => 'exists:calificacion_hechos,id',
        ];
    }
}
