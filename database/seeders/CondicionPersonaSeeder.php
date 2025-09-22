<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CondicionPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de condicion persona
        $filePath = database_path('seeders_data/condicion.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo condicion.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $condiciones = [];

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

            $condiciones[] = [
                'nombre' => $nombre,
                'codigo_sat' => $codigo, // mismo código para sat
                'codigo_snic' => $codigo, // mismo código para snic
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todas las condiciones de persona
        DB::table('condicion_personas')->insert($condiciones);

        $this->command->info('Condiciones de persona insertadas: ' . count($condiciones));
    }
}
