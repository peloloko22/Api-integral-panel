<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Persona extends FormRequest
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
            "nombre" => [
                'nullable',
                'string',
                'max:255',
            ],
            "apellido" => [
                'nullable',
                'string',
                'max:255',
            ],
            "dni" => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('personas')->ignore($this->route('persona')->id ?? null),
            ],
            "telefono" => [
                'nullable',
                'string',
                'max:20',
            ],
            "tipo_persona_id" => [
                'nullable',
                Rule::exists('tipo_personas', 'id'),
            ],
            "genero_id" => [
                'nullable',
                Rule::exists('generos', 'id'),
            ],
            "nacionalidad_id" => [
                'nullable',
                Rule::exists('nacionalidades', 'id'),
            ],
            "sexo_id" => [
                'nullable',
                Rule::exists('sexos', 'id'),
            ],
            "condicion_persona_id" => [
                'nullable',
                Rule::exists('condicion_personas', 'id'),
            ],
            "ocupacion_id" => [
                'nullable',
                Rule::exists('ocupaciones', 'id'),
            ],
            "nivel_instruccion_id" => [
                'nullable',
                Rule::exists('nivel_instrucciones', 'id'),
            ],
            "fecha_nacimiento" => [
                'nullable',
                'date',
            ],
            "alias" => [
                'nullable',
                'string',
                'max:255',
            ],
             "clase" => [
                'nullable',
                'string',
                'max:255',
            ],
            "domicilio" => [
                'nullable',
                'string',
                'max:255',
            ],
            "no_identificable" => [
                'required',
                'boolean',
            ],
            "no_identificable_nombre" => [
                'nullable',
                'string',
                'max:255',
            ],
            "capacidad_persona_id" => [
                'nullable',
                Rule::exists('capacidad_personas', 'id'),
            ],
            "estado_civil_id" => [
                'nullable',
                Rule::exists('estado_civiles', 'id'),
            ],
        ];

    }
}
