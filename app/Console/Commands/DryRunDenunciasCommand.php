<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Departamental;
use App\Models\Dependencia;
use App\Models\TipificacionDelito;
use App\Models\Fiscal;
use App\Models\Localidad;
use App\Models\Barrio;
use App\Models\Sexos;
use App\Models\Genero;
use App\Models\Nacionalidad;
use App\Models\Ocupacion;
use App\Models\NivelInstruccion;
use App\Models\CondicionPersona;
use App\Models\TipoLugar;
use App\Models\TipoVia;
use App\Models\TipoZona;
// use App\Models\FranjaHoraria; // Comentado - no se usará
use App\Models\CategoriaElemento;
use App\Models\EstadoElemento;
use App\Models\CalificacionHecho;
use App\Models\ModusOperandi;
use App\Models\RolPersona;
use Carbon\Carbon;

class DryRunDenunciasCommand extends Command
{
    protected $signature = 'denuncias:dry-run {--limit=5 : Número máximo de denuncias a procesar}';
    protected $description = 'Ejecuta un dry run del seeder de denuncias para verificar el mapeo de datos';

    private $dependencias = [];
    private $departamentales = [];
    private $tipificaciones = [];
    private $fiscales = [];
    private $localidades = [];
    private $barrios = [];
    private $sexos = [];
    private $generos = [];
    private $nacionalidades = [];
    private $ocupaciones = [];
    private $nivelesInstruccion = [];
    private $condicionesPersona = [];
    private $tiposLugar = [];
    private $tiposVia = [];
    private $tiposZona = [];
    private $franjasHorarias = [];
    private $categoriasElemento = [];
    private $estadosElemento = [];
    private $calificaciones = [];
    private $modusOperandi = [];
    private $rolesPersona = [];

    private $stats = [
        'denuncias_procesadas' => 0,
        'personas_encontradas' => 0,
        'personas_nuevas' => 0,
        'dependencias_encontradas' => 0,
        'tipificaciones_encontradas' => 0,
        'fiscales_encontrados' => 0,
        'localidades_encontradas' => 0,
        'barrios_encontrados' => 0,
        'elementos_procesados' => 0,
        'errores' => 0,
    ];

    public function handle()
    {
        $this->info('🔍 Iniciando DRY RUN del seeder de denuncias...');
        $this->newLine();

        // Cargar datos de referencia
        $this->cargarDatosReferencia();

        // Leer el archivo JSON
        $jsonPath = resource_path('denucias.json');
        if (!file_exists($jsonPath)) {
            $this->error('❌ No se encontró el archivo denucias.json en resources/');
            return 1;
        }

        $denunciasData = json_decode(file_get_contents($jsonPath), true);
        if (!$denunciasData) {
            $this->error('❌ Error al leer el archivo JSON');
            return 1;
        }

        $limit = $this->option('limit');
        $totalDenuncias = count($denunciasData);
        $denunciasAProcesar = min($limit, $totalDenuncias);

        $this->info("📊 Procesando {$denunciasAProcesar} de {$totalDenuncias} denuncias disponibles...");
        $this->newLine();

        // Procesar denuncias
        for ($i = 0; $i < $denunciasAProcesar; $i++) {
            $this->procesarDenuncia($denunciasData[$i], $i + 1);
        }

        // Mostrar estadísticas finales
        $this->mostrarEstadisticas();

        return 0;
    }

    private function cargarDatosReferencia(): void
    {
        $this->info('📚 Cargando datos de referencia...');

        // Cargar dependencias y departamentales
        $this->departamentales = Departamental::pluck('id', 'codigo')->toArray();
        $this->dependencias = Dependencia::with('departamental')
            ->get()
            ->keyBy(function ($item) {
                return $item->codigo;
            })
            ->toArray();

        // Cargar tipificaciones
        $this->tipificaciones = TipificacionDelito::pluck('id', 'nombre')->toArray();

        // Cargar fiscales
        $this->fiscales = Fiscal::pluck('id', 'nombre')->toArray();

        // Cargar datos geográficos
        $this->localidades = Localidad::pluck('id', 'nombre')->toArray();
        $this->barrios = Barrio::pluck('id', 'nombre')->toArray();

        // Cargar datos de personas
        $this->sexos = Sexos::pluck('id', 'nombre')->toArray();
        $this->generos = Genero::pluck('id', 'nombre')->toArray();
        $this->nacionalidades = Nacionalidad::pluck('id', 'nombre')->toArray();
        $this->ocupaciones = Ocupacion::pluck('id', 'nombre')->toArray();
        $this->nivelesInstruccion = NivelInstruccion::pluck('id', 'nombre')->toArray();
        $this->condicionesPersona = CondicionPersona::pluck('id', 'nombre')->toArray();

        // Cargar datos de lugar
        $this->tiposLugar = TipoLugar::pluck('id', 'nombre')->toArray();
        $this->tiposVia = TipoVia::pluck('id', 'nombre')->toArray();
        $this->tiposZona = TipoZona::pluck('id', 'nombre')->toArray();
        // $this->franjasHorarias = FranjaHoraria::pluck('id', 'nombre')->toArray(); // Comentado - franja horaria será null

        // Cargar datos de elementos y delitos
        $this->categoriasElemento = CategoriaElemento::pluck('id', 'nombre')->toArray();
        $this->estadosElemento = EstadoElemento::pluck('id', 'nombre')->toArray();
        $this->calificaciones = CalificacionHecho::pluck('id', 'nombre')->toArray();
        $this->modusOperandi = ModusOperandi::pluck('id', 'nombre')->toArray();
        $this->rolesPersona = RolPersona::pluck('id', 'nombre')->toArray();

        $this->info("   ✅ Departamentales: " . count($this->departamentales));
        $this->info("   ✅ Dependencias: " . count($this->dependencias));
        $this->info("   ✅ Tipificaciones: " . count($this->tipificaciones));
        $this->info("   ✅ Fiscales: " . count($this->fiscales));
        $this->info("   ✅ Localidades: " . count($this->localidades));
        $this->info("   ✅ Barrios: " . count($this->barrios));
        $this->newLine();
    }

    private function procesarDenuncia(array $data, int $numero): void
    {
        $this->info("🔄 Procesando denuncia #{$numero}");

        try {
            // Mostrar información básica
            $this->line("   📅 Fecha hecho: " . ($data['FECHA DEL HECHO'] ?? 'N/A'));
            $this->line("   📅 Fecha denuncia: " . ($data['FECHA DE LA DENUNCIA '] ?? 'N/A'));
            $this->line("   🏢 Departamental: " . ($data['DEPARTAMENTAL '] ?? 'N/A'));
            $this->line("   🏛️  Dependencia: " . ($data['CRIAS. Y SUBCRIAS'] ?? 'N/A'));

            // Procesar personas
            $this->procesarPersonas($data);

            // Procesar ubicación
            $this->procesarUbicacion($data);

            // Procesar tipificación
            $this->procesarTipificacion($data);

            // Procesar fiscal
            $this->procesarFiscal($data);

            // Procesar elementos
            $this->procesarElementos($data);

            $this->stats['denuncias_procesadas']++;
            $this->info("   ✅ Denuncia #{$numero} procesada exitosamente");

        } catch (\Exception $e) {
            $this->error("   ❌ Error en denuncia #{$numero}: " . $e->getMessage());
            $this->stats['errores']++;
        }

        $this->newLine();
    }

    private function procesarPersonas(array $data): void
    {
        // Denunciante
        $denunciante = $data['APELLIDOS Y NOMBRES  (DENUNCIANTE.)'] ?? null;
        if ($denunciante) {
            $this->line("   👤 Denunciante: {$denunciante}");
            $this->line("      DNI: " . ($data['DNI (DENUNCIANTE.)'] ?? 'N/A'));
            $this->line("      Sexo: " . $this->mapearValor($data['SEXO  (DENUNCIANTE)'] ?? '', $this->sexos));
            $this->line("      Nacionalidad: " . $this->mapearValor($data['NACIONALIDAD (ej. ARGENTINA) (DENUNCIANTE.)\n'] ?? '', $this->nacionalidades));
            $this->stats['personas_nuevas']++;
        }

        // Víctima
        $esElMismo = ($data['EL DENUNCIANTE ES EL MISMO QUE DAMNIFICADO ?'] ?? '') === 'SI';
        if ($esElMismo) {
            $this->line("   👤 Víctima: [MISMO QUE DENUNCIANTE]");
        } else {
            $victima = $data['APELLIDOS Y NOMBRES - ENTIDAD (DAMNIF / VICT.)'] ?? null;
            if ($victima) {
                $this->line("   👤 Víctima: {$victima}");
                $this->stats['personas_nuevas']++;
            }
        }

        // Imputado
        $tipoImputado = $data['IMPUTADO/ INCULPADO (IMPUT 1)'] ?? '';
        if (strpos($tipoImputado, 'DESCONOCIDO') !== false) {
            $this->line("   👤 Imputado: [DESCONOCIDO]");
        } else {
            $imputado = $data['APELLIDOS Y NOMBRES  (IMPUT 1)'] ?? null;
            if ($imputado) {
                $this->line("   👤 Imputado: {$imputado}");
                $this->line("      DNI: " . ($data['DNI (IMPUT 1)'] ?? 'N/A'));
                $this->stats['personas_nuevas']++;
            }
        }
    }

    private function procesarUbicacion(array $data): void
    {
        // Departamental
        $departamental = $this->buscarDepartamental($data);
        $this->line("   🏢 Departamental: " . ($departamental ? "✅ ENCONTRADO (ID: {$departamental})" : "❌ NO ENCONTRADO"));
        if ($departamental) $this->stats['dependencias_encontradas']++;

        // Dependencia
        $dependencia = $this->buscarDependencia($data);
        $this->line("   🏛️  Dependencia: " . ($dependencia ? "✅ ENCONTRADA (ID: {$dependencia})" : "❌ NO ENCONTRADA"));

        // Localidad
        $localidad = $this->buscarLocalidad($data['LOCALIDAD '] ?? '');
        $localidadNombre = $data['LOCALIDAD '] ?? 'N/A';
        $this->line("   📍 Localidad ({$localidadNombre}): " . ($localidad ? "✅ ENCONTRADA (ID: {$localidad})" : "❌ NO ENCONTRADA"));
        if ($localidad) $this->stats['localidades_encontradas']++;

        // Barrio
        $barrio = $this->buscarBarrio($data['BARRIO'] ?? '');
        $barrioNombre = $data['BARRIO'] ?? 'N/A';
        $this->line("   🏘️  Barrio ({$barrioNombre}): " . ($barrio ? "✅ ENCONTRADO (ID: {$barrio})" : "❌ NO ENCONTRADO"));
        if ($barrio) $this->stats['barrios_encontrados']++;

        // Coordenadas
        if (isset($data['LATITUD ']) && isset($data['LONGITUD'])) {
            $this->line("   🗺️  Coordenadas: {$data['LATITUD ']}, {$data['LONGITUD']}");
        }
    }

    private function procesarTipificacion(array $data): void
    {
        $campos = [
            'CONTRA LA PROPIEDAD (TIPIF)',
            'CONTRA LAS PERSONAS (TIPIF)',
            'CONTRA LA LIBERTAD (TIPIF)',
            'CONTRA LA INTEGRIDAD SEXUAL  (TIPIF)'
        ];

        $tipificacionEncontrada = false;
        foreach ($campos as $campo) {
            if (!empty($data[$campo])) {
                $tipificacionId = $this->buscarTipificacionPorTexto($data[$campo]);
                $this->line("   ⚖️  {$campo}: " . ($tipificacionId ? "✅ ENCONTRADA (ID: {$tipificacionId})" : "❌ NO ENCONTRADA"));
                $this->line("      Texto: {$data[$campo]}");
                if ($tipificacionId) {
                    $tipificacionEncontrada = true;
                    $this->stats['tipificaciones_encontradas']++;
                }
            }
        }

        if (!$tipificacionEncontrada) {
            $this->warn("   ⚠️  No se encontró ninguna tipificación para esta denuncia");
        }
    }

    private function procesarFiscal(array $data): void
    {
        $fiscal = $data['FISCALES '] ?? '';
        if ($fiscal) {
            $fiscalId = $this->buscarFiscal($data);
            $this->line("   👨‍💼 Fiscal ({$fiscal}): " . ($fiscalId ? "✅ ENCONTRADO (ID: {$fiscalId})" : "❌ NO ENCONTRADO"));
            if ($fiscalId) $this->stats['fiscales_encontrados']++;
        }
    }

    private function procesarElementos(array $data): void
    {
        if (!empty($data['ELEMENTOS ']) && !empty($data['ELEMENTOS (CONDICION)'])) {
            $categoria = $this->buscarCategoriaElemento($data['ELEMENTOS ']);
            $estado = $this->buscarEstadoElemento($data['ELEMENTOS (CONDICION)']);

            $this->line("   📦 Elemento: {$data['ELEMENTOS ']} ({$data['ELEMENTOS (CONDICION)']})");
            $this->line("      Categoría: " . ($categoria ? "✅ ENCONTRADA (ID: {$categoria})" : "❌ NO ENCONTRADA"));
            $this->line("      Estado: " . ($estado ? "✅ ENCONTRADO (ID: {$estado})" : "❌ NO ENCONTRADO"));
            $this->line("      Cantidad: " . ($data['CANTIDAD '] ?? 'N/A'));
            $this->line("      Marca: " . ($data['MARCA '] ?? 'N/A'));
            $this->line("      Descripción: " . ($data['DESCRIPCION'] ?? 'N/A'));

            $this->stats['elementos_procesados']++;
        }
    }

    private function mostrarEstadisticas(): void
    {
        $this->newLine();
        $this->info('📊 ESTADÍSTICAS DEL DRY RUN:');
        $this->newLine();

        $this->table(
            ['Concepto', 'Cantidad', 'Estado'],
            [
                ['Denuncias procesadas', $this->stats['denuncias_procesadas'], '✅'],
                ['Personas nuevas', $this->stats['personas_nuevas'], '👤'],
                ['Dependencias encontradas', $this->stats['dependencias_encontradas'], $this->getEstadoIcono($this->stats['dependencias_encontradas'])],
                ['Tipificaciones encontradas', $this->stats['tipificaciones_encontradas'], $this->getEstadoIcono($this->stats['tipificaciones_encontradas'])],
                ['Fiscales encontrados', $this->stats['fiscales_encontrados'], $this->getEstadoIcono($this->stats['fiscales_encontrados'])],
                ['Localidades encontradas', $this->stats['localidades_encontradas'], $this->getEstadoIcono($this->stats['localidades_encontradas'])],
                ['Barrios encontrados', $this->stats['barrios_encontrados'], $this->getEstadoIcono($this->stats['barrios_encontrados'])],
                ['Elementos procesados', $this->stats['elementos_procesados'], '📦'],
                ['Errores', $this->stats['errores'], $this->stats['errores'] > 0 ? '❌' : '✅'],
            ]
        );

        $this->newLine();

        if ($this->stats['errores'] === 0) {
            $this->info('🎉 DRY RUN completado sin errores. El seeder debería funcionar correctamente.');
        } else {
            $this->warn("⚠️  Se encontraron {$this->stats['errores']} errores. Revisa los detalles arriba.");
        }

        // Recomendaciones
        $this->newLine();
        $this->info('💡 RECOMENDACIONES:');

        if ($this->stats['dependencias_encontradas'] < $this->stats['denuncias_procesadas']) {
            $this->warn('   - Algunas dependencias no fueron encontradas. Verifica los códigos en la base de datos.');
        }

        if ($this->stats['tipificaciones_encontradas'] < $this->stats['denuncias_procesadas']) {
            $this->warn('   - Algunas tipificaciones no fueron encontradas. Verifica los nombres en la base de datos.');
        }

        if ($this->stats['fiscales_encontrados'] < $this->stats['denuncias_procesadas']) {
            $this->warn('   - Algunos fiscales no fueron encontrados. Verifica los nombres en la base de datos.');
        }

        $this->info('   - Para ejecutar el seeder real: php artisan db:seed --class=DenunciasJsonSeeder');
    }

    private function getEstadoIcono(int $cantidad): string
    {
        return $cantidad > 0 ? '✅' : '❌';
    }

    private function mapearValor(string $texto, array $datos): string
    {
        if (empty($texto)) return 'N/A';

        $textoLimpio = $this->limpiarTexto($texto);
        foreach ($datos as $nombre => $id) {
            if (stripos($textoLimpio, $this->limpiarTexto($nombre)) !== false) {
                return "✅ {$nombre} (ID: {$id})";
            }
        }

        return "❌ '{$texto}' no encontrado";
    }

    // Métodos de búsqueda (copiados del seeder original)
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
}
