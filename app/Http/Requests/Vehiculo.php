<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Vehiculo extends FormRequest
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
            'dominio' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('vehiculos')->ignore($this->route('vehiculo')->id ?? null),
            ],
            'tipo_vehiculo_id' => [
                'required',
                'exists:tipo_vehiculos,id',
            ],
            'marca' => [
                'nullable',
                'string',
                'max:255',
            ],
            'modelo' => [
                'nullable',
                'string',
                'max:255',
            ],
            'color' => [
                'nullable',
                'string',
                'max:255',
            ],
            'numero_motor' => [
                'nullable',
                'string',
                'max:255',
            ],
            'numero_chasis' => [
                'nullable',
                'string',
                'max:255',
            ],
            'extra' => [
                'nullable',
                'string',
            ],
            'no_identificable' => [
                'required',
                'boolean',
            ],
            'no_identificable_nombre' => [
                'nullable',
                'string',
                'max:255',
            ],
            'pedido_captura' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
