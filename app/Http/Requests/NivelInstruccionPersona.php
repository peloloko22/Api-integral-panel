<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NivelInstruccionPersona extends FormRequest
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
            
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('nivel_instrucciones')->ignore($this->route('nivel_instruccion_persona')->id ?? null),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:255',
            ],

        ];
    }
}
