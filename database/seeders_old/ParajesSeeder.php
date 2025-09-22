<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParajesSeeder extends Seeder
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

        DB::table('parajes')->insert([
            [
                'id' => 1,
                'nombre' => 'Paraje Centro',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Paraje Norte',
                'localidad_id' => $localidades[1],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Paraje Sur',
                'localidad_id' => $localidades[2],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Paraje Este',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Paraje Oeste',
                'localidad_id' => $localidades[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
