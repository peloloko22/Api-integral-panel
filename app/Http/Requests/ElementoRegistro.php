<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElementoRegistro extends FormRequest
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
            'categoria_elemento_id' => 'required|exists:categoria_elementos,id',
            'estado_elemento_id' => 'required|exists:estado_elementos,id',
            'cantidad' => 'required|numeric|min:0.01',
            'marca' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'valor' => 'nullable|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:1000',
            // luego hacer requerido si estado elemento es secuestrado
            'fecha_secuestro' => 'nullable|date',
        ];
    }
}
