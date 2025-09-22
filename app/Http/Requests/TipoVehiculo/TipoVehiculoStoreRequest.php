<?php

namespace App\Http\Requests\TipoVehiculo;

use Illuminate\Foundation\Http\FormRequest;

class TipoVehiculoStoreRequest extends FormRequest
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
            'codigo_sat' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'codigo_sat.string' => 'El código SAT debe ser una cadena de texto.',
            'codigo_sat.max' => 'El código SAT no debe exceder los 255 caracteres.',
        ];
    }
}
