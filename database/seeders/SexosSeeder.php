<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de sexos
        $filePath = database_path('seeders_data/sexo.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo sexo.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $sexos = [];

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

            $sexos[] = [
                'nombre' => $nombre,
                'descripcion' => null, // null como solicitaste
                'codigo_sat' => $codigo, // mismo código para sat
                'codigo_snic' => $codigo, // mismo código para snic
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los sexos
        DB::table('sexos')->insert($sexos);

        $this->command->info('Sexos insertados: ' . count($sexos));
    }
}
