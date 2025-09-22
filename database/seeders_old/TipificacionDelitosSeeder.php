<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipificacionDelitosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de delitos
        $filePath = database_path('seeders/datadelitos.txt');
        $fileContent = file_get_contents($filePath);
        $lines = explode("\n", $fileContent);
        
        $tipificaciones = [];
        $id = 1;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            // Dividir por la última coma
            $lastCommaPos = strrpos($line, ',');
            if ($lastCommaPos === false) continue;
            
            $nombre = trim(substr($line, 0, $lastCommaPos));
            $codigo = trim(substr($line, $lastCommaPos + 1));
            
            // Asegurar que el código está en el formato correcto
            $codigo_sat = str_replace('_', '', $codigo);
            $codigo_snic = $codigo;
            
            $tipificaciones[] = [
                'id' => $id++,
                'categoria_delito_id' => 1, // Categoría general
                'codigo_sat' => $codigo_sat,
                'codigo_snic' => $codigo_snic,
                'nombre' => $nombre,
                'homicidio' => false, // Valor por defecto
                'descripcion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Insertar los datos en la tabla
        DB::table('tipificacion_delitos')->insert($tipificaciones);
        
        // Crear vinculaciones con modus operandis
        $this->crearVinculacionesModusOperandi();
        
        // Crear vinculaciones con calificaciones
        $this->crearVinculacionesCalificaciones();
    }
    
    /**
     * Crear vinculaciones entre tipificaciones y modus operandis
     */
    private function crearVinculacionesModusOperandi(): void
    {
        // Obtener todas las tipificaciones y modus operandis
        $tipificaciones = DB::table('tipificacion_delitos')->pluck('id')->toArray();
        $modusOperandis = DB::table('modus_operandis')->pluck('id')->toArray();
        
        if (empty($tipificaciones) || empty($modusOperandis)) {
            $this->command->warn('No hay tipificaciones o modus operandis disponibles para crear vinculaciones.');
            return;
        }
        
        $vinculaciones = [];
        
        // Crear vinculaciones lógicas entre delitos y modus operandis
        foreach ($tipificaciones as $tipificacionId) {
            // Cada tipificación se vincula con 1-3 modus operandis aleatorios
            $numModusOperandis = rand(1, min(3, count($modusOperandis)));
            $modusOperandisSeleccionados = array_rand(array_flip($modusOperandis), $numModusOperandis);
            
            if (!is_array($modusOperandisSeleccionados)) {
                $modusOperandisSeleccionados = [$modusOperandisSeleccionados];
            }
            
            foreach ($modusOperandisSeleccionados as $modusOperandiId) {
                $vinculaciones[] = [
                    'modus_operandi_id' => $modusOperandiId,
                    'tipificacion_delito_id' => $tipificacionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // Insertar las vinculaciones
        if (!empty($vinculaciones)) {
            DB::table('modus_operandi_tipificaciones')->insert($vinculaciones);
            $this->command->info('Se crearon ' . count($vinculaciones) . ' vinculaciones con modus operandis.');
        }
    }
    
    /**
     * Crear vinculaciones entre tipificaciones y calificaciones
     */
    private function crearVinculacionesCalificaciones(): void
    {
        // Obtener todas las tipificaciones y calificaciones
        $tipificaciones = DB::table('tipificacion_delitos')->pluck('id')->toArray();
        $calificaciones = DB::table('calificacion_hechos')->pluck('id')->toArray();
        
        if (empty($tipificaciones) || empty($calificaciones)) {
            $this->command->warn('No hay tipificaciones o calificaciones disponibles para crear vinculaciones.');
            return;
        }
        
        $vinculaciones = [];
        
        // Crear vinculaciones lógicas entre delitos y calificaciones
        foreach ($tipificaciones as $tipificacionId) {
            // Cada tipificación se vincula con 1-2 calificaciones aleatorias
            $numCalificaciones = rand(1, min(2, count($calificaciones)));
            $calificacionesSeleccionadas = array_rand(array_flip($calificaciones), $numCalificaciones);
            
            if (!is_array($calificacionesSeleccionadas)) {
                $calificacionesSeleccionadas = [$calificacionesSeleccionadas];
            }
            
            foreach ($calificacionesSeleccionadas as $calificacionId) {
                $vinculaciones[] = [
                    'calificacion_id' => $calificacionId,
                    'tipificacion_id' => $tipificacionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // Insertar las vinculaciones
        if (!empty($vinculaciones)) {
            DB::table('calificacion_tipificaciones')->insert($vinculaciones);
            $this->command->info('Se crearon ' . count($vinculaciones) . ' vinculaciones con calificaciones.');
        }
    }
}
