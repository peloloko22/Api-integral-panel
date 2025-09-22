<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaElemento extends FormRequest
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
                'required',
                'string',
                'max:255',
                Rule::unique('categoria_elementos')->ignore($this->route('categoria_elemento')->id ?? null),
            ],
            "es_dinero" => [
                'required',
                'boolean',
            ],
        ];
    }
}
