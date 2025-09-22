<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener departamentos y municipios existentes
        $departamentos = DB::table('departamentos')->pluck('id')->toArray();
        $municipios = DB::table('municipios')->pluck('id')->toArray();
        
        if (empty($departamentos)) {
            $this->command->warn('No hay departamentos disponibles. Ejecute DepartamentosSeeder primero.');
            return;
        }

        if (empty($municipios)) {
            $this->command->warn('No hay municipios disponibles. Ejecute MunicipiosSeeder primero.');
            return;
        }

        DB::table('localidades')->insert([
            [
                'id' => 1,
                'nombre' => 'Localidad Capital',
                'codigo' => 'LC001',
                'departamento_id' => $departamentos[0],
                'municipio_id' => $municipios[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Localidad Norte',
                'codigo' => 'LN002',
                'departamento_id' => $departamentos[0],
                'municipio_id' => $municipios[1],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Localidad Sur',
                'codigo' => 'LS003',
                'departamento_id' => $departamentos[0],
                'municipio_id' => $municipios[2],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
