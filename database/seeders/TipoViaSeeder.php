<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipoViaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de tipo via
        $filePath = database_path('seeders_data/tipo_via.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo tipo_via.txt no encontrado');
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

        // Insertar todos los tipos de via
        DB::table('tipo_vias')->insert($tipos);

        $this->command->info('Tipos de via insertados: ' . count($tipos));
    }
}
