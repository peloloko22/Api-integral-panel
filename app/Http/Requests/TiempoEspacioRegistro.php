<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiempoEspacioRegistro extends FormRequest
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
            'localidad_id' => 'nullable|exists:localidades,id',
            'tipo_lugar_id' => 'required|exists:tipo_lugares,id',
            'tipo_via_id' => 'required|exists:tipo_vias,id',
            'paraje_id' => 'nullable|exists:parajes,id',
            'barrio_id' => 'nullable|exists:barrios,id',
            'fecha_hecho' => 'required|date',
            'fecha_denuncia' => 'required|date',
            'dia_de_la_semana' => 'required|string|max:20',
            'franja_horaria_id' => 'nullable|exists:franja_horarias,id',
            'mas_detalles_direccion' => 'nullable|string|max:255',
            'calle_ruta' => 'required|string|max:255',
            'altura_km' => 'nullable|string|max:255',
            'tipo_zona_id' => 'required|exists:tipo_zonas,id',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ];
    }
}
