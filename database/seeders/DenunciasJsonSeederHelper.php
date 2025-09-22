<?php

namespace Database\Seeders;

use App\Models\Denuncia;
use App\Models\Registro;
use App\Models\TiempoEspacioRegistro;
use App\Models\PersonaRegistro;
use App\Models\RegistroHecho;
use App\Models\ElementoRegistro;
use App\Models\Personas;
use App\Models\TipoDenuncia;
use App\Models\TipoRegistro;
use Carbon\Carbon;

trait DenunciasJsonSeederHelper
{
    private function cargarDatosReferencia(): void
    {
        $this->command->info('Cargando datos de referencia...');

        // Cargar dependencias y departamentales
        $this->departamentales = \App\Models\Departamental::pluck('id', 'codigo')->toArray();
        $this->dependencias = \App\Models\Dependencia::with('departamental')
            ->get()
            ->keyBy(function ($item) {
                return $item->codigo;
            })
            ->toArray();

        // Cargar tipificaciones
        $this->tipificaciones = \App\Models\TipificacionDelito::pluck('id', 'nombre')->toArray();

        // Cargar fiscales
        $this->fiscales = \App\Models\Fiscal::pluck('id', 'nombre')->toArray();

        // Cargar datos geográficos
        $this->localidades = \App\Models\Localidad::pluck('id', 'nombre')->toArray();
        $this->barrios = \App\Models\Barrio::pluck('id', 'nombre')->toArray();

        // Cargar datos de personas
        $this->sexos = \App\Models\Sexos::pluck('id', 'nombre')->toArray();
        $this->generos = \App\Models\Genero::pluck('id', 'nombre')->toArray();
        $this->nacionalidades = \App\Models\Nacionalidad::pluck('id', 'nombre')->toArray();
        $this->ocupaciones = \App\Models\Ocupacion::pluck('id', 'nombre')->toArray();
        $this->nivelesInstruccion = \App\Models\NivelInstruccion::pluck('id', 'nombre')->toArray();
        $this->condicionesPersona = \App\Models\CondicionPersona::pluck('id', 'nombre')->toArray();

        // Cargar datos de lugar
        $this->tiposLugar = \App\Models\TipoLugar::pluck('id', 'nombre')->toArray();
        $this->tiposVia = \App\Models\TipoVia::pluck('id', 'nombre')->toArray();
        $this->tiposZona = \App\Models\TipoZona::pluck('id', 'nombre')->toArray();
        // $this->franjasHorarias = \App\Models\FranjaHoraria::pluck('id', 'nombre')->toArray(); // Comentado - franja horaria será null

        // Cargar datos de elementos y delitos
        $this->categoriasElemento = \App\Models\CategoriaElemento::pluck('id', 'nombre')->toArray();
        $this->estadosElemento = \App\Models\EstadoElemento::pluck('id', 'nombre')->toArray();
        $this->calificaciones = \App\Models\CalificacionHecho::pluck('id', 'nombre')->toArray();
        $this->modusOperandi = \App\Models\ModusOperandi::pluck('id', 'nombre')->toArray();
        $this->rolesPersona = \App\Models\RolPersona::pluck('id', 'nombre')->toArray();
    }

    private function procesarDenuncia(array $data, int $numero): void
    {
        $this->command->info("Procesando denuncia #{$numero}...");

        try {
            // 1. Crear o buscar personas (denunciante, víctima, imputado)
            $denuncianteId = $this->procesarPersonaDenunciante($data);
            $victimaId = $this->procesarPersonaVictima($data);
            $imputadoId = $this->procesarPersonaImputado($data);

            // 2. Buscar dependencia y tipificación
            $dependenciaId = $this->buscarDependencia($data);
            $tipificacionId = $this->buscarTipificacion($data);
            $fiscalId = $this->buscarFiscal($data);

            // 3. Crear la denuncia
            $denuncia = Denuncia::create([
                'tipo_denuncia_id' => $this->obtenerTipoDenuncia($data['TIPO DE INTERVENCION '] ?? 'DENUNCIA'),
                'dependencia_id' => $dependenciaId,
                'tipificacion_delito_id' => $tipificacionId,
                'fecha_hecho' => $this->parsearFecha($data['FECHA DEL HECHO'] ?? null),
                'fecha_denuncia' => $this->parsearFecha($data['FECHA DE LA DENUNCIA '] ?? null),
                'fiscal_id' => $fiscalId,
                'funcionario_interviniente' => $data['APELLIDO Y NOMBRE FUNC. (TOMÓ LA DENUNCIA)'] ?? null,
                'victima_id' => $victimaId,
                'denunciante_id' => $denuncianteId,
                'registrada_en_estadisticas' => isset($data['LP DEL CARGADOR (ESTADISTICAS)']),
                'relato' => $data['RELATO'] ?? null,
            ]);

            // 4. Crear el registro asociado
            $this->crearRegistro($denuncia, $data, $denuncianteId, $victimaId, $imputadoId);
        } catch (\Exception $e) {
            $this->command->warn("Error procesando denuncia #{$numero}: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::warning("Error procesando denuncia #{$numero}: " . $e->getMessage());
        }
    }

    private function crearRegistro(Denuncia $denuncia, array $data, $denuncianteId, $victimaId, $imputadoId): void
    {
        // Crear el registro
        $registro = Registro::create([
            'denuncia_id' => $denuncia->id,
            'tipo_registro_id' => $this->obtenerTipoRegistro('DENUNCIA'),
            'departamental_id' => $this->buscarDepartamental($data),
            'dependencia_id' => $denuncia->dependencia_id,
        ]);

        // Crear tiempo-espacio
        $this->crearTiempoEspacio($registro, $data);

        // Crear personas del registro
        $this->crearPersonasRegistro($registro, $denuncianteId, $victimaId, $imputadoId);

        // Crear hechos del registro
        $this->crearHechosRegistro($registro, $data);

        // Crear elementos si existen
        $this->crearElementosRegistro($registro, $data);
    }

    private function crearTiempoEspacio(Registro $registro, array $data): void
    {
        $localidadId = $this->buscarLocalidad($data['LOCALIDAD '] ?? '');
        $barrioId = $this->buscarBarrio($data['BARRIO'] ?? '');
        $tipoLugarId = $this->buscarTipoLugar($data['TIPO DE LUGAR'] ?? '');
        $tipoViaId = $this->buscarTipoVia($data['TIPO DE VIA '] ?? '');
        $tipoZonaId = $this->buscarTipoZona($data['ZONA'] ?? '');
        $franjaHorariaId = null; // Franja horaria será null

        /* 
 protected $fillable = ['registro_id', 'localidad_id', 'tipo_lugar_id', 'tipo_via_id', 'paraje_id', 'barrio_id', 'fecha_hecho', 'fecha_denuncia', 'dia_de_la_semana', 'franja_horaria_id', 'calle_ruta', 'altura_km', 'mas_detalles_direccion', 'tipo_zona_id', 'latitud', 'longitud'];
*/

        TiempoEspacioRegistro::create([
            'registro_id' => $registro->id,
            'localidad_id' => $localidadId,
            'barrio_id' => $barrioId,
            'paraje_id' => null, // No tenemos parajes mapeados en el JSON
            'tipo_lugar_id' => $tipoLugarId,
            'tipo_via_id' => $tipoViaId,
            'calle_ruta' => $data['CALLE / RUTA / MZNA '] ?? null,
            'altura_km' => $data['ALTURA / KM / LOTE'] ?? null,
            'tipo_zona_id' => $tipoZonaId,
            'franja_horaria_id' => $franjaHorariaId,
            'fecha_hecho' => $this->combinarFechaHora($data['FECHA DEL HECHO'] ?? null, $data['HORA DEL HECHO (NO COLOCAR HS.)'] ?? null),
            'fecha_denuncia' => $this->combinarFechaHora($data['FECHA DE LA DENUNCIA '] ?? null, $data['HORA DE DENUNCIA'] ?? null),
            // CALCULAR A PARTIR DE LA FECHA DEL HECHO
            'dia_de_la_semana' => $this->calcularDiaDeLaSemana($this->combinarFechaHora($data['FECHA DEL HECHO'] ?? null, $data['HORA DEL HECHO (NO COLOCAR HS.)'] ?? null)),
            'latitud' => $this->limpiarCoordenada($data['LATITUD '] ?? null),
            'longitud' => $this->limpiarCoordenada($data['LONGITUD'] ?? null),
        ]);
    }

    private function calcularDiaDeLaSemana($fecha): ?string
    {
        // SI ES NULL DEVUELVE NULL
        if ($fecha === null) {
            return null;
        }
        return Carbon::parse($fecha)->format('l');
    }

    private function crearPersonasRegistro(Registro $registro, $denuncianteId, $victimaId, $imputadoId): void
    {
        // Agregar denunciante
        if ($denuncianteId) {
            PersonaRegistro::create([
                'registro_id' => $registro->id,
                'persona_id' => $denuncianteId,
                'rol_persona_registro_id' => $this->buscarRolPersona('DENUNCIANTE'),
            ]);
        }

        // Agregar víctima (si es diferente del denunciante)
        if ($victimaId && $victimaId !== $denuncianteId) {
            PersonaRegistro::create([
                'registro_id' => $registro->id,
                'persona_id' => $victimaId,
                'rol_persona_registro_id' => $this->buscarRolPersona('VICTIMA'),
            ]);
        }

        // Agregar imputado
        if ($imputadoId) {
            PersonaRegistro::create([
                'registro_id' => $registro->id,
                'persona_id' => $imputadoId,
                'rol_persona_registro_id' => $this->buscarRolPersona('IMPUTADO'),
            ]);
        }
    }

    private function crearHechosRegistro(Registro $registro, array $data): void
    {
        // Procesar delito contra la propiedad
        if (!empty($data['CONTRA LA PROPIEDAD (TIPIF)'])) {
            $tipificacionId = $this->buscarTipificacionPorTexto($data['CONTRA LA PROPIEDAD (TIPIF)']);
            if ($tipificacionId) {
                RegistroHecho::create([
                    'registro_id' => $registro->id,
                    'tipificacion_id' => $tipificacionId,
                    'calificacion_id' => $this->buscarCalificacion($data['CALIFICACION '] ?? ''),
                    'modus_id' => $this->buscarModusOperandi($data['MODALIDAD'] ?? $data['MODALIDAD (CONT. LA PROP)'] ?? ''),
                ]);
            }
        }

        // Procesar delito contra las personas
        if (!empty($data['CONTRA LAS PERSONAS (TIPIF)'])) {
            $tipificacionId = $this->buscarTipificacionPorTexto($data['CONTRA LAS PERSONAS (TIPIF)']);
            if ($tipificacionId) {
                RegistroHecho::create([
                    'registro_id' => $registro->id,
                    'tipificacion_id' => $tipificacionId,
                    'calificacion_id' => $this->buscarCalificacion($data['CALIFICACION '] ?? ''),
                    'modus_id' => $this->buscarModusOperandi($data['MODALIDAD'] ?? ''),
                ]);
            }
        }

        // Procesar delito contra la libertad
        if (!empty($data['CONTRA LA LIBERTAD (TIPIF)'])) {
            $tipificacionId = $this->buscarTipificacionPorTexto($data['CONTRA LA LIBERTAD (TIPIF)']);
            if ($tipificacionId) {
                RegistroHecho::create([
                    'registro_id' => $registro->id,
                    'tipificacion_id' => $tipificacionId,
                    'calificacion_id' => $this->buscarCalificacion($data['CALIFICACION '] ?? ''),
                    'modus_id' => $this->buscarModusOperandi($data['MODALIDAD'] ?? ''),
                ]);
            }
        }

        // Procesar delito contra la integridad sexual
        if (!empty($data['CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)'])) {
            $tipificacionId = $this->buscarTipificacionPorTexto($data['CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)']);
            if ($tipificacionId) {
                RegistroHecho::create([
                    'registro_id' => $registro->id,
                    'tipificacion_id' => $tipificacionId,
                    'calificacion_id' => $this->buscarCalificacion($data['CALIFICACION '] ?? ''),
                    'modus_id' => $this->buscarModusOperandi($data['MODALIDAD'] ?? ''),
                ]);
            }
        }
    }

    private function buscarTipoMoneda($texto): ?int
    {
        return \App\Models\TipoMoneda::where('nombre', $texto)->first()?->id;
    }

    private function limpiarCoordenada($coordenada): ?float
    {
        if (empty($coordenada)) {
            return null;
        }

        // Convertir a string y limpiar
        $coordenada = (string) $coordenada;

        // Remover espacios
        $coordenada = str_replace(' ', '', $coordenada);

        // Si tiene comas, reemplazar la primera coma por punto y eliminar las demás
        if (strpos($coordenada, ',') !== false) {
            $partes = explode(',', $coordenada);
            if (count($partes) > 1) {
                // Primera parte + punto + resto unido sin comas
                $coordenada = $partes[0] . '.' . implode('', array_slice($partes, 1));
            }
        }

        // Convertir a float
        $valor = (float) $coordenada;

        // Validar rangos de coordenadas geográficas
        // Latitud: -90 a 90, Longitud: -180 a 180
        if ($valor < -90 || $valor > 90) {
            // Si parece ser longitud (fuera del rango de latitud)
            if ($valor < -180 || $valor > 180) {
                return null; // Coordenada inválida
            }
        }

        // Redondear a 6 decimales para coincidir con la definición de la BD
        return round($valor, 6);
    }

    private function crearElementosRegistro(Registro $registro, array $data): void
    {
        if (!empty($data['ELEMENTOS ']) && !empty($data['ELEMENTOS (CONDICION)'])) {
            $categoriaId = $this->buscarCategoriaElemento($data['ELEMENTOS '] ?? 'OTROS');
            $estadoId = $this->buscarEstadoElemento($data['ELEMENTOS (CONDICION)'] ?? 'SUSTRAIDO');

            ElementoRegistro::create([
                'registro_id' => $registro->id,
                'categoria_elemento_id' => $categoriaId,
                'estado_elemento_id' => $estadoId,
                'tipo_moneda_id' => $this->buscarTipoMoneda($data['MONEDA'] ?? ''),
                'cantidad' => $this->limpiarNumero($data['CANTIDAD '] ?? 1),
                'marca' => $data['MARCA '] ?? null,
                'color' => $data['COLOR'] ?? null,
                'descripcion' => $data['DESCRIPCION'] ?? null,
            ]);
        }
    }
}
