<?php

namespace App\Http\Requests\RolSiniestro;

use Illuminate\Foundation\Http\FormRequest;

class RolSiniestroUpdateRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'descripcion.max' => 'El campo descripción no puede tener más de 255 caracteres.',
        ];
    }
}

/**
 * Get the validation error messages.
 *
 * @return array<string, string>
 */
