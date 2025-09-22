<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipoZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de tipo zona
        $filePath = database_path('seeders_data/tipo_zona.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo tipo_zona.txt no encontrado');
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

            $nombre = $line;

            $tipos[] = [
                'nombre' => $nombre,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los tipos de zona
        DB::table('tipo_zonas')->insert($tipos);

        $this->command->info('Tipos de zona insertados: ' . count($tipos));
    }
}
