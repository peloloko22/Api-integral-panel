<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de departamentos
        $filePath = database_path('seeders_data/departamentos.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo departamentos.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $departamentos = [];

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

            $departamentos[] = [
                'nombre' => $nombre,
                'codigo' => $codigo,
                'provincia_id' => 1, // Siempre provincia ID 1
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los departamentos
        DB::table('departamentos')->insert($departamentos);

        $this->command->info('Departamentos insertados: ' . count($departamentos));
    }
}
