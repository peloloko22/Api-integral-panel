<?php

namespace App\Http\Requests\AlertaJerarquia;

use Illuminate\Foundation\Http\FormRequest;

class AlertaJerarquiaStoreRequest extends FormRequest
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
            'alerta_id' => 'required|exists:alertas,id',
            'jerarquia_id' => 'required|exists:jerarquias,id',
        ];
    }
}
