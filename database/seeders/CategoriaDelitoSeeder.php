<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriaDelitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de categoria delitos
        $filePath = database_path('seeders_data/categoria_delitos.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo categoria_delitos.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $categorias = [];
        $codigo = 1; // Código inicial

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            $nombre = $line;

            $categorias[] = [
                'nombre' => $nombre,
                'descripcion' => null, // null para todos los casos
                'codigo_sat' => $codigo, // código numérico arbitrario
                'codigo_snic' => $codigo, // mismo código para snic
                'created_at' => now(),
                'updated_at' => now()
            ];

            $codigo++;
        }

        // Insertar todas las categorias de delitos
        DB::table('categoria_delitos')->insert($categorias);

        $this->command->info('Categorias de delitos insertadas: ' . count($categorias));
    }
}
