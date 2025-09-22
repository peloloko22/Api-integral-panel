<?php

namespace Database\Seeders;

// use App\Models\FranjaHoraria; // Comentado - no se usará
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DenunciasJsonSeeder extends Seeder
{
    use DenunciasJsonSeederHelper, DenunciasJsonSeederUtils;
    
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

    public function run(): void
    {
        $this->command->info('Iniciando carga de denuncias desde JSON...');
        
        // Cargar datos de referencia
        $this->cargarDatosReferencia();
        
        // Leer el archivo JSON
        $jsonPath = resource_path('denucias.json');
        if (!file_exists($jsonPath)) {
            $this->command->error('No se encontró el archivo denucias.json en resources/');
            return;
        }
        
        $denunciasData = json_decode(file_get_contents($jsonPath), true);
        if (!$denunciasData) {
            $this->command->error('Error al leer el archivo JSON');
            return;
        }
        
        $this->command->info('Procesando ' . count($denunciasData) . ' denuncias...');
        
        DB::beginTransaction();
        try {
            foreach ($denunciasData as $index => $denunciaData) {
                $this->procesarDenuncia($denunciaData, $index + 1);
            }
            
            DB::commit();
            $this->command->info('Denuncias cargadas exitosamente!');
            
        } catch (\Exception $e) {
            DB::rollback();
            $this->command->error('Error al procesar denuncias: ' . $e->getMessage());
            Log::error('Error en DenunciasJsonSeeder: ' . $e->getMessage());
        }
    }
}