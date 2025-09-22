<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModusOperandiTipificacion extends FormRequest
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
            'modus_operandi_ids' => [
                'nullable',
                'array',
            ],
            'modus_operandi_ids.*' => [
                'exists:modus_operandis,id',
            ],
            'tipificacion_id' => [
                'required',
                Rule::exists('tipificacion_delitos', 'id')
            ],
        ];
    }
}
