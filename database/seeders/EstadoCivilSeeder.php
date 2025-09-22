<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de estado civil
        $filePath = database_path('seeders_data/estado_civil.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo estado_civil.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $estados = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            $nombre = $line;

            $estados[] = [
                'nombre' => $nombre,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los estados civiles
        DB::table('estado_civiles')->insert($estados);

        $this->command->info('Estados civiles insertados: ' . count($estados));
    }
}
