<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TipoTransporteImputadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de transporte imputado
        $filePath = database_path('seeders_data/transporte_imputado.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo transporte_imputado.txt no encontrado');
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

        // Insertar todos los tipos de transporte imputado
        DB::table('tipo_transporte_imputados')->insert($tipos);

        $this->command->info('Tipos de transporte imputado insertados: ' . count($tipos));
    }
}
