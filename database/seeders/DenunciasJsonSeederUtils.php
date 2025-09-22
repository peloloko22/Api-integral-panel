<?php

namespace Database\Seeders;

use App\Models\Personas;
use App\Models\TipoDenuncia;
use App\Models\TipoRegistro;
use Carbon\Carbon;

trait DenunciasJsonSeederUtils
{
    // Métodos auxiliares para procesar personas
    private function procesarPersonaDenunciante(array $data): ?int
    {
        $nombre = $data['APELLIDOS Y NOMBRES  (DENUNCIANTE.)'] ?? null;
        if (empty($nombre)) return null;

        $persona = $this->crearOBuscarPersona([
            'nombre_completo' => $nombre,
            'dni' => $data['DNI (DENUNCIANTE.)'] ?? null,
            'fecha_nacimiento' => $this->parsearFecha($data['FECHA NAC. (DENUNCIANTE.)'] ?? null),
            'domicilio' => $data['DOMICILIO (DENUNCIANTE)'] ?? null,
            'nacionalidad' => $data['NACIONALIDAD (ej. ARGENTINA) (DENUNCIANTE.)\n'] ?? null,
            'sexo' => $data['SEXO  (DENUNCIANTE)'] ?? null,
            'genero' => $data['GENERO (DENUNC.)'] ?? null,
            'ocupacion' => $data['OCUPACION (DENUNCIANTE)'] ?? null,
            'nivel_instruccion' => $data['NIVEL DE INSTRUCCION (DENUNCIANTE)'] ?? null,
            'condicion' => $data['CLASE / CONDICION (DENUNCIANTE)'] ?? null,
        ]);

        return $persona->id;
    }

    private function procesarPersonaVictima(array $data): ?int
    {
        // Si el denunciante es la misma persona que la víctima
        if (($data['EL DENUNCIANTE ES EL MISMO QUE DAMNIFICADO ?'] ?? '') === 'SI') {
            return $this->procesarPersonaDenunciante($data);
        }

        $nombre = $data['APELLIDOS Y NOMBRES - ENTIDAD (DAMNIF / VICT.)'] ?? null;
        if (empty($nombre)) return null;

        $persona = $this->crearOBuscarPersona([
            'nombre_completo' => $nombre,
            'domicilio' => $data['DOMICILIO (DAMNIF.  / VICT.)'] ?? null,
            'nacionalidad' => $data['NACIONALIDAD (DAMNIF / VICT.)'] ?? null,
            'sexo' => $data['SEXO  (DAMNIF / VICT.)'] ?? null,
            'genero' => $data['GENERO (DAMNIF / VICT.)'] ?? null,
            'nivel_instruccion' => $data['NIVEL DE INSTRUCCION (DAMNIF / VICT.)'] ?? null,
            'condicion' => $data['CLASE / CONDICION (DAMNIF. / VICT.)'] ?? null,
        ]);

        return $persona->id;
    }

    private function procesarPersonaImputado(array $data): ?int
    {
        // Si es desconocido, no crear persona
        if (($data['IMPUTADO/ INCULPADO (IMPUT 1)'] ?? '') === 'DESCONOCIDO,     2') {
            return null;
        }

        $nombre = $data['APELLIDOS Y NOMBRES  (IMPUT 1)'] ?? null;
        if (empty($nombre)) return null;

        $persona = $this->crearOBuscarPersona([
            'nombre_completo' => $nombre,
            'alias' => $data['ALIAS / APODO (IMPUT 1)'] ?? null,
            'dni' => $data['DNI (IMPUT 1)'] ?? null,
            'domicilio' => $data['DOMICILIO (IMPUT 1)'] ?? null,
            'nacionalidad' => $data['NACIONALIDAD (IMPUT 1)'] ?? null,
            'sexo' => $data['SEXO  (IMPUT 1)'] ?? null,
            'genero' => $data['GENERO (IMPUT 1)'] ?? null,
            'ocupacion' => $data['OCUPACION (IMPUT 1)'] ?? null,
            'nivel_instruccion' => $data['NIVEL DE INSTRUCCION (IMPUT 1)'] ?? null,
            'condicion' => $data['CLASE / CONDICION (IMPUT 1)'] ?? null,
        ]);

        return $persona->id;
    }

    private function crearOBuscarPersona(array $datosPersona): Personas
    {
        $nombreCompleto = $datosPersona['nombre_completo'] ?? '';
        $dni = $datosPersona['dni'] ?? null;

        // Separar nombre y apellido
        $partesNombre = explode(' ', trim($nombreCompleto));
        $apellido = array_shift($partesNombre);
        $nombre = implode(' ', $partesNombre);

        // Buscar persona existente solo por DNI
        $persona = null;
        if ($dni) {
            $persona = Personas::where('dni', $dni)->first();
            if ($persona) {
                // Actualizar propiedades de la persona existente solo si están vacías
                $datosActualizacion = [];

                // Campos básicos - solo actualizar si están vacíos
                if ($nombre && empty($persona->nombre)) {
                    $datosActualizacion['nombre'] = $nombre;
                }
                if ($apellido && empty($persona->apellido)) {
                    $datosActualizacion['apellido'] = $apellido;
                }
                if (!empty($datosPersona['alias']) && empty($persona->alias)) {
                    $datosActualizacion['alias'] = $datosPersona['alias'];
                }
                if (!empty($datosPersona['domicilio']) && empty($persona->domicilio)) {
                    $datosActualizacion['domicilio'] = $datosPersona['domicilio'];
                }
                if (!empty($datosPersona['fecha_nacimiento']) && empty($persona->fecha_nacimiento)) {
                    $datosActualizacion['fecha_nacimiento'] = $datosPersona['fecha_nacimiento'];
                }

                // Campos de relación - solo actualizar si están vacíos
                $nuevoSexoId = $this->buscarSexo($datosPersona['sexo'] ?? '');
                if ($nuevoSexoId && empty($persona->sexo_id)) {
                    $datosActualizacion['sexo_id'] = $nuevoSexoId;
                }

                $nuevoGeneroId = $this->buscarGenero($datosPersona['genero'] ?? '');
                if ($nuevoGeneroId && empty($persona->genero_id)) {
                    $datosActualizacion['genero_id'] = $nuevoGeneroId;
                }

                $nuevaNacionalidadId = $this->buscarNacionalidad($datosPersona['nacionalidad'] ?? '');
                if ($nuevaNacionalidadId && empty($persona->nacionalidad_id)) {
                    $datosActualizacion['nacionalidad_id'] = $nuevaNacionalidadId;
                }

                $nuevaOcupacionId = $this->buscarOcupacion($datosPersona['ocupacion'] ?? '');
                if ($nuevaOcupacionId && empty($persona->ocupacion_id)) {
                    $datosActualizacion['ocupacion_id'] = $nuevaOcupacionId;
                }

                $nuevoNivelInstruccionId = $this->buscarNivelInstruccion($datosPersona['nivel_instruccion'] ?? '');
                if ($nuevoNivelInstruccionId && empty($persona->nivel_instruccion_id)) {
                    $datosActualizacion['nivel_instruccion_id'] = $nuevoNivelInstruccionId;
                }

                $nuevaCondicionId = $this->buscarCondicionPersona($datosPersona['condicion'] ?? '');
                if ($nuevaCondicionId && empty($persona->condicion_persona_id)) {
                    $datosActualizacion['condicion_persona_id'] = $nuevaCondicionId;
                }

                // Solo actualizar si hay datos para actualizar
                if (!empty($datosActualizacion)) {
                    $persona->update($datosActualizacion);
                }
                return $persona;
            }
        }

        // Crear nueva persona
        return Personas::create([
            'nombre' => $nombre ?: 'SIN NOMBRE',
            'apellido' => $apellido ?: 'SIN APELLIDO',
            'alias' => $datosPersona['alias'] ?? null,
            'dni' => $dni,
            'domicilio' => $datosPersona['domicilio'] ?? null,
            'fecha_nacimiento' => $datosPersona['fecha_nacimiento'] ?? null,
            'sexo_id' => $this->buscarSexo($datosPersona['sexo'] ?? ''),
            'genero_id' => $this->buscarGenero($datosPersona['genero'] ?? ''),
            'nacionalidad_id' => $this->buscarNacionalidad($datosPersona['nacionalidad'] ?? ''),
            'ocupacion_id' => $this->buscarOcupacion($datosPersona['ocupacion'] ?? ''),
            'nivel_instruccion_id' => $this->buscarNivelInstruccion($datosPersona['nivel_instruccion'] ?? ''),
            'condicion_persona_id' => $this->buscarCondicionPersona($datosPersona['condicion'] ?? ''),
        ]);
    }

    // Métodos de búsqueda y mapeo
    private function buscarDependencia(array $data): ?int
    {
        $codigoDependencia = $this->extraerCodigo($data['CRIAS. Y SUBCRIAS'] ?? '');

        foreach ($this->dependencias as $codigo => $dependencia) {
            if ($codigo == $codigoDependencia) {
                return $dependencia['id'];
            }
        }

        return null;
    }

    private function buscarDepartamental(array $data): ?int
    {
        $codigoDepartamental = $this->extraerCodigo($data['DEPARTAMENTAL '] ?? '');

        return $this->departamentales[$codigoDepartamental] ?? null;
    }

    private function buscarTipificacion(array $data): ?int
    {
        // Buscar en diferentes campos de tipificación
        $campos = [
            'CONTRA LA PROPIEDAD (TIPIF)',
            'CONTRA LAS PERSONAS (TIPIF)',
            'CONTRA LA LIBERTAD (TIPIF)',
            'CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)'
        ];

        foreach ($campos as $campo) {
            if (!empty($data[$campo])) {
                $tipificacionId = $this->buscarTipificacionPorTexto($data[$campo]);
                if ($tipificacionId) {
                    return $tipificacionId;
                }
            }
        }

        return null;
    }

    private function buscarTipificacionPorTexto(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->tipificaciones as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarFiscal(array $data): ?int
    {
        $fiscal = $data['FISCALES '] ?? '';
        $fiscalLimpio = $this->limpiarTexto($fiscal);

        foreach ($this->fiscales as $nombre => $id) {
            if (stripos($fiscalLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarLocalidad(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->localidades as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarBarrio(string $texto): ?int
    {
        if (empty($texto) || $texto === 'SIN BARRIO' || $texto === 'SIN DATOS') {
            return null;
        }

        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->barrios as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    // Métodos de búsqueda para datos de personas
    private function buscarSexo(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->sexos as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarGenero(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->generos as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarNacionalidad(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->nacionalidades as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarOcupacion(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->ocupaciones as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarNivelInstruccion(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->nivelesInstruccion as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarCondicionPersona(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->condicionesPersona as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    // Métodos de búsqueda para datos de lugar y elementos
    private function buscarTipoLugar(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->tiposLugar as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarTipoVia(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->tiposVia as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarTipoZona(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->tiposZona as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarFranjaHoraria(string $texto): ?int
    {
        // Franja horaria deshabilitada - siempre retorna null
        return null;
    }

    private function buscarCategoriaElemento(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->categoriasElemento as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarEstadoElemento(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->estadosElemento as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarCalificacion(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->calificaciones as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarModusOperandi(string $texto): ?int
    {
        $textoLimpio = $this->limpiarTexto($texto);

        foreach ($this->modusOperandi as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return $id;
            }
        }

        return null;
    }

    private function buscarRolPersona(string $rol): ?int
    {
        return $this->rolesPersona[strtoupper($rol)] ?? null;
    }

    private function obtenerTipoDenuncia(string $tipo): int
    {
        $tipoDenuncia = TipoDenuncia::firstOrCreate(['nombre' => 'DENUNCIA']);
        return $tipoDenuncia->id;
    }

    private function obtenerTipoRegistro(string $tipo): int
    {
        $tipoRegistro = TipoRegistro::firstOrCreate(['nombre' => $tipo]);
        return $tipoRegistro->id;
    }

    // Métodos utilitarios
    private function extraerCodigo(string $texto): ?string
    {
        if (preg_match('/(\d+)/', $texto, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function limpiarTexto(string $texto): string
    {
        return strtoupper(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $texto)));
    }

    private function limpiarNumero($valor): int
    {
        if (is_numeric($valor)) {
            return (int) $valor;
        }

        $numero = preg_replace('/[^0-9]/', '', $valor);
        return $numero ? (int) $numero : 1;
    }

    private function parsearFecha(?string $fecha): ?string
    {
        if (empty($fecha)) return null;

        try {
            // Intentar diferentes formatos de fecha
            $formatos = ['d/m/Y', 'Y-m-d', 'd-m-Y'];

            foreach ($formatos as $formato) {
                $fechaParsed = Carbon::createFromFormat($formato, $fecha);
                if ($fechaParsed) {
                    return $fechaParsed->format('Y-m-d');
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parsearHora(?string $hora): ?string
    {
        if (empty($hora)) return null;

        try {
            // Limpiar la hora y asegurar formato HH:MM
            $hora = preg_replace('/[^0-9:]/', '', $hora);
            if (preg_match('/^\d{1,2}:\d{2}$/', $hora)) {
                return $hora . ':00'; // Agregar segundos
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function combinarFechaHora(?string $fecha, ?string $hora): string
    {
        try {
            // Si no hay fecha, usar fecha muy antigua para filtrar fácilmente
            if (empty($fecha)) {
                return '1900-01-01 00:00:00';
            }

            $fechaParsed = $this->parsearFecha($fecha);
            if (!$fechaParsed) {
                return '1900-01-01 00:00:00';
            }

            // Si no hay hora, usar 00:00:00
            if (empty($hora)) {
                return $fechaParsed . ' 00:00:00';
            }

            $horaParsed = $this->parsearHora($hora);
            if (!$horaParsed) {
                return $fechaParsed . ' 00:00:00';
            }

            // Combinar fecha y hora
            return $fechaParsed . ' ' . $horaParsed;
        } catch (\Exception $e) {
            // En caso de error, usar fecha muy antigua
            return '1900-01-01 00:00:00';
        }
    }
}
