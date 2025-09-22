<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriaElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo de categoria elemento
        $filePath = database_path('seeders_data/categoria_elemento.txt');
        
        if (!File::exists($filePath)) {
            $this->command->error('Archivo categoria_elemento.txt no encontrado');
            return;
        }

        $content = File::get($filePath);
        $lines = explode("\n", trim($content));

        $categorias = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Dividir por la coma y obtener nombre y es_dinero
            $parts = explode(',', $line);
            if (count($parts) !== 2) {
                continue;
            }

            $nombre = trim($parts[0]);
            $es_dinero = (int)trim($parts[1]) === 1; // Convertir 0/1 a boolean

            $categorias[] = [
                'nombre' => $nombre,
                'es_dinero' => $es_dinero,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insertar todas las categorias de elementos
        DB::table('categoria_elementos')->insert($categorias);

        $this->command->info('Categorias de elementos insertadas: ' . count($categorias));
    }
}
