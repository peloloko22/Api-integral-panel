<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModusOperandi extends FormRequest
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
            'codigo_sat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modus_operandis')->ignore($this->route('modus_operandi')->id ?? null),
            ],
            'codigo_snic' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modus_operandis')->ignore($this->route('modus_operandi')->id ?? null),
            ],
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modus_operandis')->ignore($this->route('modus_operandi')->id ?? null),
            ],
        ];
    }
}
