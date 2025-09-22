<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NivelInstruccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de nivel instruccion
        $filePath = database_path('seeders_data/nivel_instruccion.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo nivel_instruccion.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $niveles = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            $nombre = $line;

            $niveles[] = [
                'nombre' => $nombre,
                'descripcion' => null, // null para todos los casos
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todos los niveles de instruccion
        DB::table('nivel_instrucciones')->insert($niveles);

        $this->command->info('Niveles de instruccion insertados: ' . count($niveles));
    }
}
