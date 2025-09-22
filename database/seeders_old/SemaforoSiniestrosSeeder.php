<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemaforoSiniestrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semaforo_siniestros')->insert([
            [
                'id' => 1,
                'nombre' => 'Verde',
                'codigo' => 'VER',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Amarillo',
                'codigo' => 'AMA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Rojo',
                'codigo' => 'ROJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Sin Semáforo',
                'codigo' => 'SIN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Semáforo Apagado',
                'codigo' => 'APA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
