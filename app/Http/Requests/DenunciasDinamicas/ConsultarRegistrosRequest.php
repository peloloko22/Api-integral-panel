<?php

namespace App\Http\Requests\DenunciasDinamicas;

use Illuminate\Foundation\Http\FormRequest;

class ConsultarRegistrosRequest extends FormRequest
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
            // Filtros generales
            'departamentales' => 'nullable|string|regex:/^[\d,]+$/',
            'dependencias' => 'nullable|string|regex:/^[\d,]+$/',
            'tipos_intervencion' => 'nullable|string|regex:/^[\d,]+$/',
            
            // Filtros geográficos
            'localidades' => 'nullable|string|regex:/^[\d,]+$/',
            'barrios' => 'nullable|string|regex:/^[\d,]+$/',
            'zonas' => 'nullable|array',
            'zonas.*' => 'string|in:URBANO / SUBURBANO,RURAL',
            'tipos_lugar' => 'nullable|array',
            'tipos_lugar.*' => 'string|max:255',
            
            // Filtros temporales
            'fecha_hecho_desde' => 'nullable|date|before_or_equal:today',
            'fecha_hecho_hasta' => 'nullable|date|after_or_equal:fecha_hecho_desde|before_or_equal:today',
            'fecha_denuncia_desde' => 'nullable|date|before_or_equal:today',
            'fecha_denuncia_hasta' => 'nullable|date|after_or_equal:fecha_denuncia_desde|before_or_equal:today',
            'franjas_horarias' => 'nullable|array',
            'franjas_horarias.*' => 'string|in:00:00 A 05:59,06:00 A 11:59,12:00 A 17:59,18:00 A 23:59,SIN DETERMINAR',
            
            // Filtros de personas
            'generos_personas' => 'nullable|string|regex:/^[\d,]+$/',
            'edad_minima' => 'nullable|integer|min:0|max:150',
            'edad_maxima' => 'nullable|integer|min:0|max:150|gte:edad_minima',
            'nacionalidades' => 'nullable|array',
            'nacionalidades.*' => 'string|max:100',
            'roles_personas' => 'nullable|string|regex:/^[\d,]+$/',
            
            // Filtros de hechos
            'tipificaciones' => 'nullable|string|regex:/^[\d,]+$/',
            'calificaciones' => 'nullable|string|regex:/^[\d,]+$/',
            'modalidades' => 'nullable|array',
            'modalidades.*' => 'string|max:255',
            'tipos_arma' => 'nullable|array',
            'tipos_arma.*' => 'string|max:255',
            'categorias_hechos' => 'nullable|array',
            'categorias_hechos.*' => 'string|in:DELITOS CONTRA LAS PERSONAS,DELITOS CONTRA LA PROPIEDAD,DELITOS CONTRA LA LIBERTAD,DELITOS CONTRA LA INTEGRIDAD SEXUAL Y HONOR,DELITOS CONTRA LA SEG. PUBLICA,INFRACC. LEY 23 737 (ESTUPEF. TIPIF),DELITOS AMBIENTALES,DELITOS MIGRATORIOS,CONTRABANDO,OTRAS CATEGORIAS DE DEL.,OTROS DELITOS',
            
            // Filtros de elementos
            'tipos_elementos' => 'nullable|array',
            'tipos_elementos.*' => 'string|max:255',
            'condiciones_elementos' => 'nullable|array',
            'condiciones_elementos.*' => 'string|in:SUSTRAIDO,RECUPERADO,SECUESTRADO,INCAUTADO',
            'marcas' => 'nullable|array',
            'marcas.*' => 'string|max:100',
            'valor_minimo' => 'nullable|numeric|min:0',
            'valor_maximo' => 'nullable|numeric|min:0|gte:valor_minimo',
            
            // Filtros judiciales
            'circunscripciones' => 'nullable|array',
            'circunscripciones.*' => 'string|max:255',
            'competencias' => 'nullable|array',
            'competencias.*' => 'string|max:255',
            'fiscales' => 'nullable|array',
            'fiscales.*' => 'string|max:255',
            'esclarecidos' => 'nullable|boolean',
            
            // Búsqueda por texto
            'search' => 'nullable|string|min:3|max:255',
            'search_fields' => 'nullable|array',
            'search_fields.*' => 'string|in:relato,nombres,dni,elementos,descripcion',
            
            // Configuración de respuesta
            'with_all_relations' => 'nullable|boolean',
            'all' => 'nullable|boolean',
            'per_page' => 'nullable|integer|min:1|max:100',
            'sort' => 'nullable|string|in:created_at,updated_at,id,tipo_registro_id,departamental_id,dependencia_id',
            'direction' => 'nullable|string|in:asc,desc',
            
            // Filtros avanzados
            'coordenadas_bbox' => 'nullable|array|size:4',
            'coordenadas_bbox.*' => 'numeric',
            'radio_busqueda' => 'nullable|numeric|min:0.1|max:100',
            'coordenada_central' => 'nullable|array|size:2',
            'coordenada_central.0' => 'numeric|between:-90,90', // latitud
            'coordenada_central.1' => 'numeric|between:-180,180', // longitud
            
            // Filtros de tiempo específicos
            'dias_semana' => 'nullable|array',
            'dias_semana.*' => 'integer|min:0|max:6', // 0=Domingo, 6=Sábado
            'meses' => 'nullable|array',
            'meses.*' => 'integer|min:1|max:12',
            'años' => 'nullable|array',
            'años.*' => 'integer|min:2000|max:' . date('Y'),
            
            // Agrupaciones y estadísticas
            'agrupar_por' => 'nullable|array',
            'agrupar_por.*' => 'string|in:departamental,localidad,barrio,tipificacion,modalidad,franja_horaria,mes,año',
            'incluir_estadisticas' => 'nullable|boolean',
            'incluir_conteos' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'departamentales.regex' => 'Los departamentales deben ser una lista de números separados por comas.',
            'dependencias.regex' => 'Las dependencias deben ser una lista de números separados por comas.',
            'tipos_intervencion.regex' => 'Los tipos de intervención deben ser una lista de números separados por comas.',
            'localidades.regex' => 'Las localidades deben ser una lista de números separados por comas.',
            'barrios.regex' => 'Los barrios deben ser una lista de números separados por comas.',
            
            'fecha_hecho_desde.before_or_equal' => 'La fecha del hecho desde no puede ser posterior a hoy.',
            'fecha_hecho_hasta.after_or_equal' => 'La fecha del hecho hasta debe ser posterior o igual a la fecha desde.',
            'fecha_hecho_hasta.before_or_equal' => 'La fecha del hecho hasta no puede ser posterior a hoy.',
            
            'fecha_denuncia_desde.before_or_equal' => 'La fecha de denuncia desde no puede ser posterior a hoy.',
            'fecha_denuncia_hasta.after_or_equal' => 'La fecha de denuncia hasta debe ser posterior o igual a la fecha desde.',
            'fecha_denuncia_hasta.before_or_equal' => 'La fecha de denuncia hasta no puede ser posterior a hoy.',
            
            'edad_minima.min' => 'La edad mínima debe ser mayor a 0.',
            'edad_minima.max' => 'La edad mínima debe ser menor a 150.',
            'edad_maxima.gte' => 'La edad máxima debe ser mayor o igual a la edad mínima.',
            
            'search.min' => 'El término de búsqueda debe tener al menos 3 caracteres.',
            'search.max' => 'El término de búsqueda no puede exceder 255 caracteres.',
            
            'per_page.min' => 'El número de resultados por página debe ser al menos 1.',
            'per_page.max' => 'El número de resultados por página no puede exceder 100.',
            
            'coordenadas_bbox.size' => 'Las coordenadas de bounding box deben contener exactamente 4 valores [min_lat, min_lng, max_lat, max_lng].',
            'coordenada_central.size' => 'La coordenada central debe contener exactamente 2 valores [latitud, longitud].',
            'coordenada_central.0.between' => 'La latitud debe estar entre -90 y 90 grados.',
            'coordenada_central.1.between' => 'La longitud debe estar entre -180 y 180 grados.',
            
            'radio_busqueda.min' => 'El radio de búsqueda debe ser al menos 0.1 km.',
            'radio_busqueda.max' => 'El radio de búsqueda no puede exceder 100 km.',
            
            'zonas.*.in' => 'La zona debe ser URBANO / SUBURBANO o RURAL.',
            'franjas_horarias.*.in' => 'La franja horaria debe ser una de las opciones válidas.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     */
    public function attributes(): array
    {
        return [
            'departamentales' => 'departamentales',
            'dependencias' => 'dependencias',
            'tipos_intervencion' => 'tipos de intervención',
            'localidades' => 'localidades',
            'barrios' => 'barrios',
            'fecha_hecho_desde' => 'fecha del hecho desde',
            'fecha_hecho_hasta' => 'fecha del hecho hasta',
            'fecha_denuncia_desde' => 'fecha de denuncia desde',
            'fecha_denuncia_hasta' => 'fecha de denuncia hasta',
            'franjas_horarias' => 'franjas horarias',
            'generos_personas' => 'géneros de personas',
            'edad_minima' => 'edad mínima',
            'edad_maxima' => 'edad máxima',
            'nacionalidades' => 'nacionalidades',
            'roles_personas' => 'roles de personas',
            'tipificaciones' => 'tipificaciones',
            'calificaciones' => 'calificaciones',
            'modalidades' => 'modalidades',
            'tipos_arma' => 'tipos de arma',
            'tipos_elementos' => 'tipos de elementos',
            'condiciones_elementos' => 'condiciones de elementos',
            'marcas' => 'marcas',
            'valor_minimo' => 'valor mínimo',
            'valor_maximo' => 'valor máximo',
            'search' => 'búsqueda',
            'per_page' => 'resultados por página',
            'coordenadas_bbox' => 'coordenadas de área',
            'coordenada_central' => 'coordenada central',
            'radio_busqueda' => 'radio de búsqueda',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Validar que si se proporciona radio_busqueda, también se proporcione coordenada_central
            if ($this->filled('radio_busqueda') && !$this->filled('coordenada_central')) {
                $validator->errors()->add('coordenada_central', 'La coordenada central es requerida cuando se especifica un radio de búsqueda.');
            }
            
            // Validar que las coordenadas de bounding box sean válidas
            if ($this->filled('coordenadas_bbox')) {
                $bbox = $this->coordenadas_bbox;
                if (count($bbox) === 4) {
                    [$minLat, $minLng, $maxLat, $maxLng] = $bbox;
                    
                    if ($minLat >= $maxLat) {
                        $validator->errors()->add('coordenadas_bbox', 'La latitud mínima debe ser menor que la latitud máxima.');
                    }
                    
                    if ($minLng >= $maxLng) {
                        $validator->errors()->add('coordenadas_bbox', 'La longitud mínima debe ser menor que la longitud máxima.');
                    }
                }
            }
            
            // Validar que no se usen filtros conflictivos
            if ($this->filled('all') && $this->boolean('all') && $this->filled('per_page')) {
                $validator->errors()->add('per_page', 'No se puede especificar per_page cuando all=true.');
            }
        });
    }

    /**
     * Get the validated data from the request with parsed arrays.
     */
    public function validatedWithParsedArrays(): array
    {
        $validated = $this->validated();
        
        // Convertir strings separados por comas a arrays
        $stringArrayFields = [
            'departamentales', 'dependencias', 'tipos_intervencion',
            'localidades', 'barrios', 'generos_personas', 'roles_personas',
            'tipificaciones', 'calificaciones'
        ];
        
        foreach ($stringArrayFields as $field) {
            if (isset($validated[$field]) && is_string($validated[$field])) {
                $validated[$field] = array_map('intval', explode(',', $validated[$field]));
            }
        }
        
        return $validated;
    }
}
