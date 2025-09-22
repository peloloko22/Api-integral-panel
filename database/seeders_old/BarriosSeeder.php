<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener localidades existentes
        $localidades = DB::table('localidades')->pluck('id')->toArray();
        
        if (empty($localidades)) {
            $this->command->warn('No hay localidades disponibles. Ejecute LocalidadesSeeder primero.');
            return;
        }

        DB::table('barrios')->insert([
            [
                'id' => 1,
                'nombre' => 'Barrio Centro',
                'codigo' => 'BC001',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Barrio Norte',
                'codigo' => 'BN002',
                'localidad_id' => $localidades[1],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Barrio Sur',
                'codigo' => 'BS003',
                'localidad_id' => $localidades[2],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Barrio Este',
                'codigo' => 'BE004',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Barrio Oeste',
                'codigo' => 'BO005',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
