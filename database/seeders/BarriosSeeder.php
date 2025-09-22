<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BarriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de barrios
        $filePath = database_path('seeders_data/barrio.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo barrio.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $barrios = [];
        $codigo = 1; // Código inicial

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            $nombre = $line;

            $barrios[] = [
                'nombre' => $nombre,
                'codigo' => str_pad($codigo, 3, '0', STR_PAD_LEFT), // Código de 3 dígitos con ceros a la izquierda
                'localidad_id' => null, // null para todos los casos
                'created_at' => now(),
                'updated_at' => now()
            ];

            $codigo++;
        }

        // Insertar todos los barrios
        DB::table('barrios')->insert($barrios);

        $this->command->info('Barrios insertados: ' . count($barrios));
    }
}
