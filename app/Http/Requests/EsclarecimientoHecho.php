<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EsclarecimientoHecho extends FormRequest
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
            'tipo_esclarecimiento_hecho_id' => 'required|exists:tipo_esclarecimiento_hechos,id',
            'descripcion' => 'required|string',
            'dependencia_esclarece' => 'required|string',
            'fecha_esclarecimiento' => 'required|date',
        ];
    }
}
