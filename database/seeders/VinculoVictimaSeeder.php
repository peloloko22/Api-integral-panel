<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VinculoVictimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de vinculo imputado victima
        $filePath = database_path('seeders_data/vinculo_imputado_victima.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo vinculo_imputado_victima.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $vinculos = [];

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

            $vinculos[] = [
                'nombre' => $nombre,
                'codigo_sat' => $codigo, // mismo código para sat
                'codigo_snic' => $codigo, // mismo código para snic
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los vinculos de victima
        DB::table('vinculo_victimas')->insert($vinculos);

        $this->command->info('Vinculos de victima insertados: ' . count($vinculos));
    }
}
