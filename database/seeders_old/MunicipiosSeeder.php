<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener departamentos existentes
        $departamentos = DB::table('departamentos')->pluck('id')->toArray();
        
        if (empty($departamentos)) {
            $this->command->warn('No hay departamentos disponibles. Ejecute DepartamentosSeeder primero.');
            return;
        }

        DB::table('municipios')->insert([
            [
                'id' => 1,
                'nombre' => 'Municipio Capital',
                'codigo' => 'MC001',
                'departamento_id' => $departamentos[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Municipio Norte',
                'codigo' => 'MN002',
                'departamento_id' => $departamentos[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Municipio Sur',
                'codigo' => 'MS003',
                'departamento_id' => $departamentos[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
