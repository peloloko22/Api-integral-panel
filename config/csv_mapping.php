<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Mapeo de Valores CSV
    |--------------------------------------------------------------------------
    |
    | Configuración para mapear los valores del CSV a los valores del sistema
    |
    */

    'sexos' => [
        'MASCULINO' => 'MASCULINO',
        'FEMENINO' => 'FEMENINO', 
        'VARON' => 'MASCULINO',
        'MUJER' => 'FEMENINO',
        '1' => 'MASCULINO',
        '2' => 'FEMENINO',
    ],

    'generos' => [
        'VARON' => 'MASCULINO',
        'MUJER' => 'FEMENINO',
        '1' => 'MASCULINO', 
        '2' => 'FEMENINO',
    ],

    'nacionalidades' => [
        'ARGENTINA' => 'ARGENTINA',
        'ARGENTINO' => 'ARGENTINA',
        'ARGENTINA/O' => 'ARGENTINA',
    ],

    'estados_civiles' => [
        'SOLTERO' => 'SOLTERO',
        'CASADO' => 'CASADO',
        'DIVORCIADO' => 'DIVORCIADO',
        'VIUDO' => 'VIUDO',
        'CONCUBINO' => 'CONCUBINO',
        'SOLTERO/A' => 'SOLTERO',
        'CASADO/A' => 'CASADO',
    ],

    'ocupaciones' => [
        'TRABAJADOR CUENTA PROPIA' => 'TRABAJADOR INDEPENDIENTE',
        'PATRÓN/EMPLEADOR' => 'EMPLEADOR',
        'JUBILADO/PENSIONADO' => 'JUBILADO',
        'AMA DE CASA' => 'AMA DE CASA',
        'DESOCUPADO' => 'DESOCUPADO',
        'OTRO (ESPECIFICAR)' => 'OTROS',
    ],

    'niveles_instruccion' => [
        'PRIMARIA COMPLETA' => 'PRIMARIO COMPLETO',
        'PRIMARIA COMPLETO' => 'PRIMARIO COMPLETO', 
        'SECUNDARIA COMPLETO' => 'SECUNDARIO COMPLETO',
        'SECUNDARIA COMPLETA' => 'SECUNDARIO COMPLETO',
        'SIN INSTRUCCION' => 'SIN INSTRUCCION',
        'UNIVERSITARIO' => 'UNIVERSITARIO',
    ],

    'tipos_delito' => [
        'HURTOS' => 'HURTO',
        '*ROBOS (EXCLUYE AGRAVADOS POR EL RESULTADO DE LESIONES Y/O MUERTES)' => 'ROBO',
        'LESIONES DOLOSAS' => 'LESIONES',
        '*AMENAZAS CALIFICADAS' => 'AMENAZAS',
        'CALUMNIAS E INJURIAS (DEL. CONTRA EL HONOR)' => 'INJURIAS',
    ],

    'modalidades_delito' => [
        'ARREBATO' => 'ARREBATO',
        'SIMPLE' => 'SIMPLE',
        'OTROS' => 'OTROS',
    ],

    'tipos_arma' => [
        'GOLPES DE PUÑO' => 'GOLPES',
        'ARMA BLANCA' => 'ARMA BLANCA',
        'SIN DETERMINAR' => 'SIN DETERMINAR',
    ],

    'departamentales' => [
        'D.S.C. ,8' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 8',
        'D.S.C. ,6' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 6',
        'D.S.C. ,16' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 16',
        'D.S.C. ,1' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 1',
        'D.S.C. ,17' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 17',
        'D.S.C. ,3' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 3',
        'D.S.C. ,15' => 'DEPARTAMENTO SEGURIDAD CIUDADANA 15',
    ],

    'jerarquias' => [
        'cabo' => 'CABO',
        'OF. INSP.' => 'OFICIAL INSPECTOR', 
        'OF. SUBINSP.' => 'OFICIAL SUB INSPECTOR',
        'OF. AYUDANTE' => 'OFICIAL AYUDANTE',
    ],

    'tipos_lugar' => [
        'DOMICILIO PARTICULAR CON MORADORES' => 'DOMICILIO PARTICULAR',
        'DOMICILIO PARTICULAR SIN MORADORES' => 'DOMICILIO PARTICULAR',
        'COMERCIO' => 'COMERCIO',
        'VIA PUBLICA' => 'VIA PUBLICA',
        'OTRO LUGAR' => 'OTRO LUGAR',
        'CAMPO' => 'CAMPO',
    ],

    'tipos_via' => [
        'CALLE' => 'CALLE',
        'AVENIDA' => 'AVENIDA', 
        'CAMINO' => 'CAMINO',
    ],

    'zonas' => [
        'URBANO / SUBURBANO' => 'URBANO',
        'RURAL' => 'RURAL',
    ],

    'condiciones_elemento' => [
        'SUSTRAIDO' => 'SUSTRAIDO',
        'RECUPERADO' => 'RECUPERADO',
        'SECUESTRADO' => 'SECUESTRADO',
    ],

    'tipos_elemento' => [
        'CELULAR, DINERO, OTROS' => 'VARIOS',
        'VEHICULO' => 'VEHICULO',
        'HERRAMIENTAS' => 'HERRAMIENTAS',
        'OTROS' => 'OTROS',
    ],

    'valores_por_defecto' => [
        'sexo_id' => 1,
        'genero_id' => 1, 
        'nacionalidad_id' => 1,
        'tipo_persona_id' => 1,
        'condicion_persona_id' => 1,
        'capacidad_persona_id' => 1,
        'estado_civil_id' => 1,
        'nivel_instruccion_id' => 1,
        'ocupacion_id' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Procesamiento
    |--------------------------------------------------------------------------
    */

    'procesamiento' => [
        'batch_size' => 50, // Procesar en lotes de 50 registros
        'timeout' => 300, // Timeout en segundos
        'max_errores' => 100, // Máximo número de errores antes de detener
        'skip_duplicados' => true, // Saltar registros duplicados por DNI
    ],

    /*
    |--------------------------------------------------------------------------
    | Validaciones
    |--------------------------------------------------------------------------
    */

    'validaciones' => [
        'dni_requerido' => false,
        'fecha_valida' => true,
        'nombres_minimo_caracteres' => 2,
        'relato_maximo_caracteres' => 10000,
    ],

];
