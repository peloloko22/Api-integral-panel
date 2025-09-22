<?php

/**
 * Script para convertir el CSV problemático a JSON estructurado
 * Ejecutar con: php scripts/convertir_csv_a_json.php
 */

require_once 'vendor/autoload.php';

function dividirCSVEnFilas(string $contenido): array
{
    $filas = [];
    $filaActual = '';
    $dentroDeComillas = false;
    
    $lineas = explode("\n", $contenido);
    
    foreach ($lineas as $linea) {
        $linea = rtrim($linea, "\r");
        
        // Contar comillas no escapadas
        $comillas = 0;
        for ($i = 0; $i < strlen($linea); $i++) {
            if ($linea[$i] === '"' && ($i === 0 || $linea[$i-1] !== '\\')) {
                $comillas++;
            }
        }
        
        if ($comillas % 2 === 1) {
            $dentroDeComillas = !$dentroDeComillas;
        }
        
        if ($dentroDeComillas) {
            $filaActual .= $linea . "\n";
        } else {
            $filaActual .= $linea;
            $filas[] = $filaActual;
            $filaActual = '';
        }
    }
    
    if (!empty($filaActual)) {
        $filas[] = $filaActual;
    }
    
    return $filas;
}

function limpiarTexto(?string $texto): ?string
{
    if (empty($texto)) {
        return null;
    }
    
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);
    
    return !empty($texto) ? $texto : null;
}

function parsearFecha(?string $fecha): ?string
{
    if (empty($fecha) || $fecha === 'SIN DETERMINAR') {
        return null;
    }

    try {
        $carbon = \Carbon\Carbon::createFromFormat('d/m/Y', $fecha);
        return $carbon->format('Y-m-d');
    } catch (Exception $e) {
        try {
            $carbon = \Carbon\Carbon::createFromFormat('Y-m-d', $fecha);
            return $carbon->format('Y-m-d');
        } catch (Exception $e2) {
            return null;
        }
    }
}

function parsearNombreCompleto(string $nombreCompleto): array
{
    $partes = explode(' ', trim($nombreCompleto));
    
    if (count($partes) === 1) {
        return ['nombre' => $partes[0], 'apellido' => ''];
    }
    
    $mitad = ceil(count($partes) / 2);
    $apellidos = array_slice($partes, 0, $mitad);
    $nombres = array_slice($partes, $mitad);
    
    return [
        'apellido' => implode(' ', $apellidos),
        'nombre' => implode(' ', $nombres)
    ];
}

// Procesar el archivo
$rutaCSV = 'resources/primeros_10_registros.csv';
$rutaJSON = 'resources/denuncias_estructuradas.json';

if (!file_exists($rutaCSV)) {
    echo "❌ Archivo CSV no encontrado: {$rutaCSV}\n";
    exit(1);
}

echo "🚀 Convirtiendo CSV a JSON estructurado...\n";

$contenido = file_get_contents($rutaCSV);
$filas = dividirCSVEnFilas($contenido);

echo "📊 Total de filas: " . count($filas) . "\n";

// Mapear encabezados
$encabezados = str_getcsv($filas[0], ',', '"');
$mapaColumnas = [];
foreach ($encabezados as $indice => $encabezado) {
    $mapaColumnas[trim($encabezado)] = $indice;
}

echo "📋 Columnas mapeadas: " . count($mapaColumnas) . "\n";

$denunciasJSON = [];

// Procesar cada fila de datos
for ($i = 1; $i < count($filas); $i++) {
    $fila = str_getcsv($filas[$i], ',', '"');
    
    if (count($fila) < 50) {
        echo "⚠️  Saltando fila {$i} (columnas insuficientes)\n";
        continue;
    }
    
    // Función auxiliar para obtener valor
    $obtenerValor = function($columna) use ($fila, $mapaColumnas) {
        $indice = $mapaColumnas[$columna] ?? null;
        return $indice !== null && isset($fila[$indice]) ? limpiarTexto($fila[$indice]) : null;
    };
    
    // Extraer datos estructurados
    $denunciante = null;
    $nombreDenunciante = $obtenerValor('APELLIDOS Y NOMBRES  (DENUNCIANTE.)');
    if (!empty($nombreDenunciante) && $nombreDenunciante !== 'DESCONOCIDO') {
        $partes = parsearNombreCompleto($nombreDenunciante);
        $denunciante = [
            'nombre_completo' => $nombreDenunciante,
            'nombre' => $partes['nombre'],
            'apellido' => $partes['apellido'],
            'dni' => $obtenerValor('DNI (DENUNCIANTE.)'),
            'fecha_nacimiento' => parsearFecha($obtenerValor('FECHA NAC. (DENUNCIANTE.)')),
            'nacionalidad' => $obtenerValor('NACIONALIDAD (ej. ARGENTINA) (DENUNCIANTE.)'),
            'sexo' => $obtenerValor('SEXO  (DENUNCIANTE)'),
            'genero' => $obtenerValor('GENERO (DENUNC.)'),
            'ocupacion' => $obtenerValor('OCUPACION (DENUNCIANTE)'),
            'domicilio' => $obtenerValor('DOMICILIO (DENUNCIANTE)'),
            'estado_civil' => $obtenerValor('ESTADO CIVIL (DENUNCIANTE)'),
            'nivel_instruccion' => $obtenerValor('NIVEL DE INSTRUCCION (DENUNCIANTE)')
        ];
    }
    
    // Víctima (si es diferente)
    $victima = null;
    $esMismaDamnificado = $obtenerValor('EL DENUNCIANTE ES EL MISMO QUE DAMNIFICADO ?');
    if ($esMismaDamnificado !== 'SI') {
        $nombreVictima = $obtenerValor('APELLIDOS Y NOMBRES - ENTIDAD (DAMNIF / VICT.)');
        if (!empty($nombreVictima) && $nombreVictima !== 'DESCONOCIDO') {
            $partes = parsearNombreCompleto($nombreVictima);
            $victima = [
                'nombre_completo' => $nombreVictima,
                'nombre' => $partes['nombre'],
                'apellido' => $partes['apellido'],
                'dni' => $obtenerValor('DNI (DAMIF / VICT.)'),
                'fecha_nacimiento' => parsearFecha($obtenerValor('FECHA DE NAC. (DAMNIF. / VICT. )')),
                'nacionalidad' => $obtenerValor('NACIONALIDAD (DAMNIF / VICT.)'),
                'sexo' => $obtenerValor('SEXO  (DAMNIF / VICT.)'),
                'genero' => $obtenerValor('GENERO (DAMNIF / VICT.)'),
                'domicilio' => $obtenerValor('DOMICILIO (DAMNIF.  / VICT.)'),
                'estado_civil' => $obtenerValor('ESTADO CIVIL (DAMNIF / VICT.)'),
                'capacidad' => $obtenerValor('CAPACIDAD (DAMNIF / VICT)')
            ];
        }
    }
    
    // Datos del delito
    $delito = [
        'categoria' => $obtenerValor('CATEGORIAS DE HECHOS'),
        'contra_personas' => $obtenerValor('CONTRA LAS PERSONAS (TIPIF)'),
        'contra_propiedad' => $obtenerValor('CONTRA LA PROPIEDAD (TIPIF)'),
        'contra_libertad' => $obtenerValor('CONTRA LA LIBERTAD (TIPIF)'),
        'contra_integridad_sexual' => $obtenerValor('CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)'),
        'calificacion' => $obtenerValor('CALIFICACION '),
        'tipo_arma' => $obtenerValor('TIPO DE ARMA / MECANISMO'),
        'modalidad' => $obtenerValor('MODALIDAD'),
        'elementos_condicion' => $obtenerValor('ELEMENTOS (CONDICION)'),
        'elementos_descripcion' => $obtenerValor('ELEMENTOS '),
        'elementos_cantidad' => $obtenerValor('CANTIDAD '),
        'elementos_marca' => $obtenerValor('MARCA '),
        'elementos_valor' => $obtenerValor('VALOR    $'),
    ];
    
    // Ubicación
    $ubicacion = [
        'departamental' => $obtenerValor('DEPARTAMENTAL '),
        'comisaria' => $obtenerValor('CRIAS. Y SUBCRIAS'),
        'departamento' => $obtenerValor('DPTO. PROVINCIAL '),
        'localidad' => $obtenerValor('LOCALIDAD '),
        'paraje' => $obtenerValor('PARAJE   / Y (LOC. NO REGISTRADAS ANT.)'),
        'barrio' => $obtenerValor('BARRIO'),
        'tipo_lugar' => $obtenerValor('TIPO DE LUGAR'),
        'tipo_via' => $obtenerValor('TIPO DE VIA '),
        'calle' => $obtenerValor('CALLE / RUTA / MZNA '),
        'altura' => $obtenerValor('ALTURA / KM / LOTE'),
        'zona' => $obtenerValor('ZONA'),
        'latitud' => $obtenerValor('LATITUD '),
        'longitud' => $obtenerValor('LONGITUD')
    ];
    
    // Datos judiciales
    $judicial = [
        'circunscripcion' => $obtenerValor('CIRCUNSCRIPCIONES'),
        'competencia' => $obtenerValor('COMPETENCIA'),
        'fiscal' => $obtenerValor('FISCALES '),
        'fecha_esclarecido' => parsearFecha($obtenerValor('FECHA DE ESCLARECIDO')),
        'dep_esclarecio' => $obtenerValor('DEP. QUE ESCLARECIO'),
        'observaciones' => $obtenerValor('OBSERVACIONES (ESCLARECIDOS)')
    ];
    
    // Crear registro estructurado
    $denuncia = [
        'id_csv' => $i,
        'marca_temporal' => $obtenerValor('Marca temporal'),
        'tipo_intervencion' => $obtenerValor('TIPO DE INTERVENCION '),
        'fecha_hecho' => parsearFecha($obtenerValor('FECHA DEL HECHO')),
        'hora_hecho' => $obtenerValor('HORA DEL HECHO (NO COLOCAR HS.)'),
        'franja_horaria' => $obtenerValor('FRANJA HORARIA'),
        'fecha_denuncia' => parsearFecha($obtenerValor('FECHA DE LA DENUNCIA ')),
        'hora_denuncia' => $obtenerValor('HORA DE DENUNCIA'),
        'jerarquia' => $obtenerValor('JERARQUIA (TOMÓ LA DENUNCIA)'),
        'funcionario' => $obtenerValor('APELLIDO Y NOMBRE FUNC. (TOMÓ LA DENUNCIA)'),
        'denunciante' => $denunciante,
        'victima' => $victima,
        'delito' => $delito,
        'ubicacion' => $ubicacion,
        'judicial' => $judicial,
        'relato' => $obtenerValor('RELATO') ?? 'Sin relato disponible'
    ];
    
    $denunciasJSON[] = $denuncia;
    echo "✅ Procesada denuncia #{$i}\n";
}

// Guardar JSON
$jsonFormateado = json_encode($denunciasJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($rutaJSON, $jsonFormateado);

echo "\n🎉 Conversión completada!\n";
echo "📁 Archivo JSON creado: {$rutaJSON}\n";
echo "📊 Total de denuncias convertidas: " . count($denunciasJSON) . "\n";
echo "\n💡 Ahora puedes usar el nuevo JSONSeeder para procesar este archivo.\n";

