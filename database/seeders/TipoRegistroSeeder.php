<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipoRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de tipo intervencion
        $filePath = database_path('seeders_data/tipo_intervencion.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo tipo_intervencion.txt no encontrado');
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

            // Dividir por la coma y obtener nombre y código
            $parts = explode(',', $line);
            if (count($parts) !== 2) {
                continue;
            }

            $nombre = trim($parts[0]);
            $codigo = trim($parts[1]);

            $tipos[] = [
                'nombre' => $nombre,
                'codigo_sat' => $codigo, // mismo código para sat
                'codigo_snic' => $codigo, // mismo código para snic
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los tipos de registro
        DB::table('tipo_registros')->insert($tipos);

        $this->command->info('Tipos de registro insertados: ' . count($tipos));
    }
}
