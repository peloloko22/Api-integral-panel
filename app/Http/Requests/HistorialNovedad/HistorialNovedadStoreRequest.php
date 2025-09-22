<?php

namespace App\Http\Requests\HistorialNovedad;

use App\Models\HistorialNovedad;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HistorialNovedadStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'novedad_id' => ['required', 'exists:novedades,id'],
            'usuario_revision_id' => ['required', 'exists:users,id'],
            'contenido' => ['required', 'string'],
            'accion' => ['required', Rule::in([HistorialNovedad::ACCION_CREACION, HistorialNovedad::ACCION_MODIFICACION, HistorialNovedad::ACCION_ELIMINACION])],
        ];
    }
}
