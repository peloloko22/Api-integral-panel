<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipoLugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de tipo lugar
        $filePath = database_path('seeders_data/tipo_lugar.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo tipo_lugar.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $tipos = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Extraer solo el nombre (antes de la primera coma)
            $parts = explode(',', $line);
            $nombre = trim($parts[0]);

            $tipos[] = [
                'nombre' => $nombre,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los tipos de lugar
        DB::table('tipo_lugares')->insert($tipos);

        $this->command->info('Tipos de lugar insertados: ' . count($tipos));
    }
}
