<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     

        DB::table('condicion_personas')->insert([
            [
                'id' => 1,
                    'nombre' => 'Civil',
                'codigo_sat' => 1,
                'codigo_snic' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Policia en servicio',
                'codigo_sat' => 2,
                'codigo_snic' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Seguridad privada',
                'codigo_sat' => 4,
                'codigo_snic' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Otra fuerza de seguridad',
                'codigo_sat' => 5,
                'codigo_snic' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Civil detenido',
                'codigo_sat' => 6,
                'codigo_snic' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Policia en franco',
                'codigo_sat' => 7,
                'codigo_snic' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Policia retirado',
                'codigo_sat' => 8,
                'codigo_snic' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'Policia detenido',
                'codigo_sat' => 9,
                'codigo_snic' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nombre' => 'Sin determinar',
                'codigo_sat' => 99,
                'codigo_snic' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
