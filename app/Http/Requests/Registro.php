<?php

namespace App\Http\Requests;

use App\Http\Requests\HechoRegistro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Registro extends FormRequest
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
            // Campos principales del registro
            "tipo_registro_id" => [
                'nullable',
                Rule::exists('tipo_registros', 'id'),
            ],
            "denuncia_id" => [
                'nullable',
                Rule::exists('denuncias', 'id'),
            ],
            "departamental_id" => [
                'nullable',
                Rule::exists('departamentales', 'id'),
            ],
            "dependencia_id" => [
                'nullable',
                Rule::exists('dependencias', 'id'),
            ],

            // Arrays principales
            "hechos" => ['nullable', 'array'],
            "personas" => ['nullable', 'array'],
            "elementos" => ['nullable', 'array'],
            "vehiculos" => ['nullable', 'array'],
            "suicidios" => ['nullable', 'array'],
            "siniestro" => ['nullable', 'array'],
            "informacion_sumaria" => ['nullable', 'array'],

            // Reglas para hechos
            "hechos.*.tipificacion_id" => 'required|exists:tipificacion_delitos,id',
            "hechos.*.calificacion_id" => 'nullable|exists:calificacion_hechos,id',
            "hechos.*.tipo_transporte_imputado_id" => 'nullable|exists:tipo_transporte_imputados,id',
            "hechos.*.modus_id" => 'nullable|exists:modus_operandis,id',
            "hechos.*.mecanismo_arma_id" => 'nullable|exists:mecanismo_armas,id',
            "hechos.*.imputado_conocido" => 'nullable|boolean',
            "hechos.*.imputado_id" => 'nullable|exists:personas,id',
            "hechos.*.victima_id" => 'nullable|exists:personas,id',
            "hechos.*.victima_vinculo_id" => 'nullable|exists:vinculo_victimas,id',
            "hechos.*.es_femicidio" => 'nullable|boolean',
            "hechos.*.violencia_genero" => 'nullable|boolean',
            "hechos.*.consecuencia_hecho_id" => 'nullable|exists:consecuencia_hechos,id',
            "hechos.*.posee_boton_antipanico" => 'nullable|boolean',
            "hechos.*.tipo_esclarecimiento_hecho_id" => 'nullable|exists:tipo_esclarecimiento_hechos,id',
            "hechos.*.descripcion" => 'nullable|string',
            "hechos.*.dependencia_esclarece" => 'nullable|string|max:255',
            "hechos.*.fecha_esclarecimiento" => 'nullable|date',

            // Reglas para personas
            "personas.*.persona_id" => 'required|exists:personas,id',
            "personas.*.rol_persona_registro_id" => 'required|exists:rol_personas,id',

            // Reglas para elementos
            "elementos.*.categoria_elemento_id" => 'required|exists:categoria_elementos,id',
            "elementos.*.estado_elemento_id" => 'required|exists:estado_elementos,id',
            "elementos.*.cantidad" => 'required|numeric|min:0.01',
            "elementos.*.marca" => 'nullable|string|max:255',
            "elementos.*.color" => 'nullable|string|max:255',
            "elementos.*.valor" => 'nullable|numeric|min:0.01',
            "elementos.*.descripcion" => 'nullable|string|max:1000',
            "elementos.*.fecha_secuestro" => 'nullable|date',
            "elementos.*.tipo_moneda_id" => 'nullable|exists:tipo_monedas,id',

            // Reglas para vehículos
            "vehiculos.*.vehiculo_id" => 'required|exists:vehiculos,id',
            "vehiculos.*.estado_vehiculo_registro_id" => 'nullable|exists:estado_vehiculo_registros,id',
            "vehiculos.*.descripcion" => 'nullable|string|max:1000',

            // Reglas para tiempo_espacio
            "tiempo_espacio.localidad_id" => 'nullable|exists:localidades,id',
            "tiempo_espacio.tipo_lugar_id" => 'required|exists:tipo_lugares,id',
            "tiempo_espacio.tipo_via_id" => 'required|exists:tipo_vias,id',
            "tiempo_espacio.paraje_id" => 'nullable|exists:parajes,id',
            "tiempo_espacio.barrio_id" => 'nullable|exists:barrios,id',
            "tiempo_espacio.fecha_hecho" => 'required|date',
            "tiempo_espacio.fecha_denuncia" => 'required|date',
            "tiempo_espacio.dia_de_la_semana" => 'required|string|max:20',
            "tiempo_espacio.franja_horaria_id" => 'nullable|exists:franja_horarias,id',
            "tiempo_espacio.mas_detalles_direccion" => 'nullable|string|max:255',
            "tiempo_espacio.calle_ruta" => 'required|string|max:255',
            "tiempo_espacio.altura_km" => 'nullable|string|max:255',
            "tiempo_espacio.tipo_zona_id" => 'required|exists:tipo_zonas,id',
            "tiempo_espacio.latitud" => 'nullable|numeric',
            "tiempo_espacio.longitud" => 'nullable|numeric',

            // Reglas para siniestro
            "siniestro.tipo_siniestro_id" => 'required_with:siniestro|exists:tipo_siniestros,id',
            "siniestro.tipo_lugar_siniestro_vial_id" => 'required_with:siniestro|exists:tipo_lugar_siniestro_viales,id',
            "siniestro.fuga" => 'required_with:siniestro|boolean',
            "siniestro.alcohol" => 'required_with:siniestro|boolean',
            "siniestro.semaforo_siniestro_id" => 'required_with:siniestro|exists:semaforo_siniestros,id',
            "siniestro.condicion_climatica_id" => 'required_with:siniestro|exists:condicion_climaticas,id',
            "siniestro.participantes" => 'required_with:siniestro|array',
            "siniestro.participantes.*.persona_id" => 'required|exists:personas,id',
            "siniestro.participantes.*.vehiculo_id" => 'nullable|exists:vehiculos,id',
            "siniestro.participantes.*.rol_siniestro_id" => 'required|exists:rol_siniestros,id',
            "siniestro.participantes.*.fallecido" => 'required|boolean',

            // Reglas para suicidios
            "suicidios.*.testigo_id" => 'nullable|exists:personas,id',
            "suicidios.*.suicida_id" => 'required|exists:personas,id',
            "suicidios.*.tipo_suicidio_id" => 'required|exists:tipo_suicidios,id',
            "suicidios.*.tipo_lugar_suicidio_id" => 'required|exists:tipo_lugar_suicidios,id',
            "suicidios.*.mecanismo_suicidio_id" => 'required|exists:mecanismo_suicidios,id',
            "suicidios.*.descripcion" => 'nullable|string|max:1000',

            // Reglas para información sumaria
            "informacion_sumaria.*.tipo_informacion_sumaria_id" => 'required|exists:tipo_informacion_sumarias,id',
            "informacion_sumaria.*.descripcion" => 'required|string|max:1000',
            "informacion_sumaria.*.personas" => 'nullable|array',
            "informacion_sumaria.*.personas.*.persona_id" => 'required|exists:personas,id',
            "informacion_sumaria.*.personas.*.extra" => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'suicidios.*.tipo_suicidio_id.required' => 'El campo tipo_suicidio_id es obligatorio.',
            'suicidios.*.tipo_suicidio_id.exists' => 'El tipo de suicidio seleccionado no existe.',
            'suicidios.*.tipo_lugar_suicidio_id.required' => 'El campo tipo_lugar_suicidio_id es obligatorio.',
            'suicidios.*.tipo_lugar_suicidio_id.exists' => 'El tipo de lugar de suicidio seleccionado no existe.',
            'suicidios.*.mecanismo_suicidio_id.required' => 'El campo mecanismo_suicidio_id es obligatorio.',
            'suicidios.*.mecanismo_suicidio_id.exists' => 'El mecanismo de suicidio seleccionado no existe.',
            'suicidios.*.suicida_id.required' => 'El campo suicida_id es obligatorio.',
            'hechos.*.registro_id.required' => 'El campo registro_id es obligatorio para cada hecho.',
            'hechos.*.registro_id.exists' => 'El registro seleccionado no existe.',
            'hechos.*.fecha_hecho.required' => 'La fecha del hecho es obligatoria.',
            'hechos.*.fecha_hecho.date' => 'La fecha del hecho debe ser una fecha válida.',
            'hechos.*.hora_hecho.date_format' => 'La hora del hecho debe tener el formato HH:mm.',
            'hechos.*.dia_de_la_semana.required' => 'El día de la semana es obligatorio.',
            'hechos.*.localidad_id.exists' => 'La localidad seleccionada no existe.',
            'hechos.*.barrio_id.exists' => 'El barrio seleccionado no existe.',
            'hechos.*.tipificacion_id.exists' => 'La tipificación seleccionada no existe.',
            'siniestro.tipo_siniestro_id.required' => 'El campo tipo_siniestro_id es obligatorio.',
            'siniestro.tipo_siniestro_id.exists' => 'El tipo de siniestro seleccionado no existe.',
            'siniestro.semaforo_siniestro_id.required' => 'El campo semaforo_siniestro_id es obligatorio.',
            'siniestro.semaforo_siniestro_id.exists' => 'El semaforo de siniestro seleccionado no existe.',
            'siniestro.condicion_climatica_id.required' => 'El campo condicion_climatica_id es obligatorio.',
            'siniestro.condicion_climatica_id.exists' => 'La condición climática seleccionada no existe.',
            'siniestro.participantes.required' => 'El campo participantes es obligatorio.',
            'siniestro.participantes.array' => 'El campo participantes debe ser un arreglo.',
            'siniestro.participantes.*.persona_id.required' => 'El campo persona_id es obligatorio.',
            'siniestro.participantes.*.persona_id.exists' => 'La persona seleccionada no existe.',
            'siniestro.participantes.*.vehiculo_id.exists' => 'El vehículo seleccionado no existe.',
            'siniestro.participantes.*.rol_siniestro_id.required' => 'El campo rol_siniestro_id es obligatorio.',
            'siniestro.participantes.*.rol_siniestro_id.exists' => 'El rol de siniestro seleccionado no existe.',
            'tiempo_espacio.localidad_id.exists' => 'La localidad seleccionada no existe.',
            'tiempo_espacio.tipo_lugar_id.required' => 'El campo tipo_lugar_id es obligatorio.',
            'tiempo_espacio.tipo_lugar_id.exists' => 'El tipo de lugar seleccionado no existe.',
            'tiempo_espacio.tipo_via_id.required' => 'El campo tipo_via_id es obligatorio.',
            'tiempo_espacio.tipo_via_id.exists' => 'El tipo de via seleccionado no existe.',
            'tiempo_espacio.paraje_id.exists' => 'El paraje seleccionado no existe.',
            'tiempo_espacio.barrio_id.exists' => 'El barrio seleccionado no existe.',
            'tiempo_espacio.fecha_hecho.required' => 'La fecha del hecho es obligatoria.',
            'tiempo_espacio.fecha_hecho.date' => 'La fecha del hecho debe ser una fecha válida.',
            'tiempo_espacio.fecha_denuncia.required' => 'La fecha de la denuncia es obligatoria.',
            'tiempo_espacio.fecha_denuncia.date' => 'La fecha de la denuncia debe ser una fecha válida.',
            'tiempo_espacio.dia_de_la_semana.required' => 'El día de la semana es obligatorio.',
            'tiempo_espacio.dia_de_la_semana.string' => 'El día de la semana debe ser una cadena de texto.',
            'tiempo_espacio.dia_de_la_semana.max' => 'El día de la semana no puede tener más de 20 caracteres.',
            'tiempo_espacio.franja_horaria_id.exists' => 'La franja horaria seleccionada no existe.',
            'tiempo_espacio.mas_detalles_direccion.string' => 'El campo mas_detalles_direccion debe ser una cadena de texto.',
            'tiempo_espacio.mas_detalles_direccion.max' => 'El campo mas_detalles_direccion no puede tener más de 255 caracteres.',
            'tiempo_espacio.calle_ruta.required' => 'El campo calle_ruta es obligatorio.',
            'tiempo_espacio.calle_ruta.string' => 'El campo calle_ruta debe ser una cadena de texto.',
            'tiempo_espacio.calle_ruta.max' => 'El campo calle_ruta no puede tener más de 255 caracteres.',
            'tiempo_espacio.altura_km.string' => 'El campo altura_km debe ser una cadena de texto.',
            'tiempo_espacio.altura_km.max' => 'El campo altura_km no puede tener más de 255 caracteres.',
            'tiempo_espacio.tipo_zona_id.required' => 'El campo tipo_zona_id es obligatorio.',
            'tiempo_espacio.tipo_zona_id.exists' => 'El tipo de zona seleccionado no existe.',
            'tiempo_espacio.latitud.numeric' => 'El campo latitud debe ser un número.',
            'tiempo_espacio.longitud.numeric' => 'El campo longitud debe ser un número.',
            'vehiculos.*.vehiculo_id.required' => 'El campo vehiculo_id es obligatorio.',
            'vehiculos.*.vehiculo_id.exists' => 'El vehículo seleccionado no existe.',
            'elementos.*.categoria_elemento_id.required' => 'El campo categoria_elemento_id es obligatorio.',
            'elementos.*.categoria_elemento_id.exists' => 'La categoría de elemento seleccionado no existe.',
            'elementos.*.tipo_moneda_id.exists' => 'El tipo de moneda seleccionado no existe.',
            'elementos.*.estado_elemento_id.required' => 'El campo estado_elemento_id es obligatorio.',
            'elementos.*.estado_elemento_id.exists' => 'El estado de elemento seleccionado no existe.',
            'elementos.*.cantidad.required' => 'El campo cantidad es obligatorio.',
            'elementos.*.cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'elementos.*.cantidad.min' => 'El campo cantidad no puede ser menor a 0.01.',
            'elementos.*.marca.string' => 'El campo marca debe ser una cadena de texto.',
            'elementos.*.marca.max' => 'El campo marca no puede tener más de 255 caracteres.',
            'elementos.*.color.string' => 'El campo color debe ser una cadena de texto.',
            'elementos.*.color.max' => 'El campo color no puede tener más de 255 caracteres.',
            'elementos.*.valor.numeric' => 'El campo valor debe ser un número.',
            'elementos.*.valor.min' => 'El campo valor no puede ser menor a 0.01.',
            'elementos.*.descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'elementos.*.descripcion.max' => 'El campo descripción no puede tener más de 1000 caracteres.',
            'elementos.*.fecha_secuestro.date' => 'La fecha de secuestro debe ser una fecha válida.',
            'siniestro.tipo_siniestro_id.required_with' => 'El campo tipo_siniestro_id es obligatorio si se incluye un siniestro.',
            'siniestro.tipo_siniestro_id.exists' => 'El tipo de siniestro seleccionado no existe.',
            'siniestro.fuga.required_with' => 'El campo fuga es obligatorio si se incluye un siniestro.',
            'siniestro.fuga.boolean' => 'El campo fuga debe ser un booleano.',
            'siniestro.alcohol.required_with' => 'El campo alcohol es obligatorio si se incluye un siniestro.',
            'siniestro.alcohol.boolean' => 'El campo alcohol debe ser un booleano.',
            'siniestro.semaforo_siniestro_id.required_with' => 'El campo semaforo_siniestro_id es obligatorio si se incluye un siniestro.',
            'siniestro.semaforo_siniestro_id.exists' => 'El semaforo de siniestro seleccionado no existe.',
            'siniestro.condicion_climatica_id.required_with' => 'El campo condicion_climatica_id es obligatorio si se incluye un siniestro.',
            'siniestro.condicion_climatica_id.exists' => 'La condición climática seleccionada no existe.',
            'siniestro.participantes.required_with' => 'El campo participantes es obligatorio si se incluye un siniestro.',
            'siniestro.participantes.array' => 'El campo participantes debe ser un arreglo.',
            'siniestro.participantes.*.persona_id.required' => 'El campo persona_id es obligatorio.',
            'siniestro.participantes.*.persona_id.exists' => 'La persona seleccionada no existe.',
            'siniestro.participantes.*.vehiculo_id.exists' => 'El vehículo seleccionado no existe.',
            'siniestro.participantes.*.rol_siniestro_id.required' => 'El campo rol_siniestro_id es obligatorio.',
            'siniestro.participantes.*.rol_siniestro_id.exists' => 'El rol de siniestro seleccionado no existe.',
            'siniestro.participantes.*.fallecido.required' => 'El campo fallecido es obligatorio.',
            'siniestro.participantes.*.fallecido.boolean' => 'El campo fallecido debe ser un booleano.',
            'personas.*.persona_id.required' => 'El campo persona_id es obligatorio.',
            'personas.*.persona_id.exists' => 'La persona seleccionada no existe.',
            'personas.*.rol_persona_registro_id.required' => 'El campo rol_persona_registro_id es obligatorio.',
            'personas.*.rol_persona_registro_id.exists' => 'El rol de persona registro seleccionado no existe.',
            'hechos.*.tipificacion_id.required' => 'El campo tipificacion_id es obligatorio.',
            'hechos.*.tipificacion_id.exists' => 'La tipificación seleccionada no existe.',
            'hechos.*.calificacion_id.exists' => 'La calificación seleccionada no existe.',
            'hechos.*.tipo_transporte_imputado_id.exists' => 'El tipo de transporte imputado seleccionado no existe.',
        ];
    }
}
