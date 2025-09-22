<?php

namespace App\Http\Requests\Novedad;

use Illuminate\Foundation\Http\FormRequest;

class NovedadStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'detalle_sintesis' => 'required|string',
            'hora_hecho' => 'required|date',
            'tipo_novedad_id' => 'required|exists:tipo_novedades,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'fiscal_id' => 'nullable|exists:fiscales,id',
            'calle_ruta' => 'nullable|string|max:255',
            'altura_km' => 'nullable|string|max:255',
            'mas_detalles_direccion' => 'nullable|string|max:255',
            'barrio_id' => 'nullable|exists:barrios,id',
            'user_id' => 'required|exists:users,id',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',

            'delitos' => 'nullable|array',
            'delitos.*.tipificacion_id' => 'exists:tipificacion_delitos,id',
            'delitos.*.modus_operandi_id' => 'nullable|exists:modus_operandis,id',
            'delitos.*.calificacion_id' => 'nullable|exists:calificacion_hechos,id',

            'marcar_revisada' => 'nullable|boolean',
            'incluir_parte' => 'nullable|boolean|required_if:marcar_revisada,1',


            'personas' => 'nullable|array',
            'personas.*.persona_id' => 'required|exists:personas,id',
            'personas.*.rol_persona_id' => 'required|exists:rol_personas,id',
            'personas.*.detalles_adicionales' => 'nullable|string',


            'vehiculos' => 'nullable|array',
            'vehiculos.*.vehiculo_id' => 'required|exists:vehiculos,id',

            'elementos' => 'nullable|array',
            'elementos.*.estado_elemento_id' => 'required|exists:estado_elementos,id',
            'elementos.*.cantidad' => 'required|integer|min:1',
            'elementos.*.categoria_elemento_id' => 'required|exists:categoria_elementos,id',
            'elementos.*.valor' => 'nullable|numeric|min:0',
            'elementos.*.detalles' => 'nullable|string',

            'siniestro' => 'nullable|array',
            'siniestro.tipo_siniestro_id' => 'required_with:siniestro|exists:tipo_siniestros,id',
            'siniestro.descripcion' => 'nullable|string',
            'siniestro.fuga' => 'nullable|boolean',
            'siniestro.alcohol' => 'nullable|boolean',

            'siniestro.participantes' => 'required_with:siniestro|array|min:1',
            'siniestro.participantes.*.persona_id' => 'required|exists:personas,id',
            'siniestro.participantes.*.rol_siniestro_id' => 'required|exists:rol_siniestros,id',
            'siniestro.participantes.*.vehiculo_id' => 'nullable|exists:vehiculos,id',

            'multimedia' => 'nullable|array',
            'multimedia.*' => 'file|mimes:jpeg,jpg,png,mp4,mov,avi|max:102400',
        ];
    }

    public function messages()
    {
        return [
            'detalle_sintesis.required' => 'El detalle síntesis es obligatorio.',
            'hora_hecho.required' => 'La hora del hecho es obligatoria.',
            'lugar_hecho.required' => 'El lugar del hecho es obligatorio.',
            'fiscal_id.exists' => 'El fiscal seleccionado no es válido.',
            'tipo_novedad_id.required' => 'El tipo de novedad es obligatorio.',
            'barrio_id.required' => 'El barrio es obligatorio.',
            'dependencia_id.required' => 'La comisaría es obligatoria.',
            'user_id.required' => 'El funcionario es obligatorio.',
            'latitud.numeric' => 'La latitud debe ser un número.',
            'longitud.numeric' => 'La longitud debe ser un número.',

            'delitos.required' => 'Al menos un delito es obligatorio.',
            'delitos.array' => 'Los delitos deben ser un arreglo.',
            'delitos.*.exists' => 'El delito seleccionado no es válido.',

            // Mensajes para personas
            'personas.array' => 'Las personas deben ser un arreglo.',
            'personas.*.tipo_participante_id.required' => 'El tipo de participante es obligatorio.',
            'personas.*.tipo_participante_id.exists' => 'El tipo de participante seleccionado no es válido.',
            'personas.*.nombre.required' => 'El nombre es obligatorio.',
            'personas.*.apellido.required' => 'El apellido es obligatorio.',
            'personas.*.dni.string' => 'El DNI debe ser una cadena de texto.',
            'personas.*.dni.max' => 'El DNI no puede tener más de 20 caracteres.',
            'personas.*.edad.integer' => 'La edad debe ser un número entero.',
            'personas.*.edad.min' => 'La edad no puede ser negativa.',
            'personas.*.domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'personas.*.alias.string' => 'El alias debe ser una cadena de texto.',
            // Mensajes para vehículos
            'vehiculos.array' => 'Los vehículos deben ser un arreglo.',
            'vehiculos.*.tipo_vehiculo_id.required' => 'El tipo de vehículo es obligatorio.',
            'vehiculos.*.tipo_vehiculo_id.exists' => 'El tipo de vehículo seleccionado no es válido.',
            'vehiculos.*.marca.required' => 'La marca es obligatoria.',
            'vehiculos.*.marca.string' => 'La marca debe ser una cadena de texto.',
            'vehiculos.*.modelo.string' => 'El modelo debe ser una cadena de texto.',
            'vehiculos.*.modelo.max' => 'El modelo no puede tener más de 100 caracteres.',
            'vehiculos.*.dominio.string' => 'El dominio debe ser una cadena de texto.',
            'vehiculos.*.dominio.max' => 'El dominio no puede tener más de 20 caracteres.',
            'vehiculos.*.detalles.string' => 'Los detalles deben ser una cadena de texto.',
            // Mensajes para elementos
            'elementos.array' => 'Los elementos deben ser un arreglo.',
            'elementos.*.estado_elemento_novedad_id.required' => 'El estado del elemento es obligatorio.',
            'elementos.*.estado_elemento_novedad_id.exists' => 'El estado del elemento seleccionado no es válido.',
            'elementos.*.cantidad.required' => 'La cantidad es obligatoria.',
            'elementos.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'elementos.*.cantidad.min' => 'La cantidad no puede ser menor a 1.',
            'elementos.*.detalles.string' => 'Los detalles deben ser una cadena de texto.',

            'siniestro.tipo_siniestro_id.required_with' => 'El tipo de siniestro es obligatorio si se incluye un siniestro.',
            'siniestro.tipo_siniestro_id.exists' => 'El tipo de siniestro seleccionado no es válido.',

            'siniestro.participantes.required_with' => 'Debe haber al menos un participante si se incluye un siniestro.',
            'siniestro.participantes.*.persona_index.required' => 'Cada participante debe referenciar una persona.',
            'siniestro.participantes.*.rol_siniestro_id.required' => 'El rol en el siniestro es obligatorio.',
            'siniestro.participantes.*.rol_siniestro_id.exists' => 'El rol en el siniestro seleccionado no es válido.',
            'siniestro.participantes.*.vehiculo_index.integer' => 'El índice del vehículo debe ser un número entero.',
        ];
    }
}
