<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de localidades
        $filePath = database_path('seeders_data/localidades.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo localidades.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $localidades = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Dividir por la coma y obtener nombre y código
            $parts = explode(',', $line);
            if (count($parts) !== 2) {
                continue;
            }

            $nombre = trim($parts[0]);
            $codigo = trim($parts[1]);

            // Verificar que el código no esté vacío
            if (empty($codigo)) {
                continue;
            }

            $localidades[] = [
                'nombre' => $nombre,
                'codigo' => $codigo,
                'departamento_id' => null, // null para todos los casos
                'municipio_id' => null,    // null para todos los casos
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todas las localidades
        DB::table('localidades')->insert($localidades);

        $this->command->info('Localidades insertadas: ' . count($localidades));
    }
}
