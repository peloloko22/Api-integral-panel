<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipificacionDelitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de tipificacion delitos
        $filePath = database_path('seeders_data/tipificacion_delitos.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo tipificacion_delitos.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $tipificaciones = [];
        $currentCategoriaId = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Verificar si es un marcador de categoría (--número)
            if (preg_match('/^--(\d+)$/', $line, $matches)) {
                $currentCategoriaId = (int)$matches[1];
                continue;
            }

            // Si no hay categoría asignada, saltar esta línea
            if ($currentCategoriaId === null) {
                continue;
            }

            // Dividir por la coma y obtener nombre y código
            $parts = explode(',', $line);
            if (count($parts) !== 2) {
                continue;
            }

            $nombre = trim($parts[0]);
            $codigo = trim($parts[1]);

            // Determinar si es homicidio basado en el nombre
            $homicidio = stripos($nombre, 'HOMICIDIO') !== false ? 1 : 0;

            $tipificaciones[] = [
                'nombre' => $nombre,
                'descripcion' => null,
                'categoria_delito_id' => $currentCategoriaId,
                'codigo_sat' => $codigo, // mismo código para sat
                'codigo_snic' => $codigo, // mismo código para snic
                'homicidio' => $homicidio,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todas las tipificaciones de delitos
        DB::table('tipificacion_delitos')->insert($tipificaciones);

        $this->command->info('Tipificaciones de delitos insertadas: ' . count($tipificaciones));
    }
}
