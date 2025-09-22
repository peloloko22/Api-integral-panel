<?php

namespace App\Http\Requests\AlertaJerarquia;

use Illuminate\Foundation\Http\FormRequest;

class AlertaJerarquiaUpdateRequest extends FormRequest
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

            'alertas_por_jerarquia' => 'required|array',
            'alertas_por_jerarquia.*.alerta_id' => 'required|exists:tipo_alertas,id',
            'alertas_por_jerarquia.*.jerarquia_id' => 'required|exists:jerarquias,id',
        ];
    }
}
