<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MecanismosSuicidioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mecanismo_suicidios')->insert([
            [
                'id' => 1,
                'nombre' => 'Ahorcamiento',
                'codigo' => 'AHO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Intoxicación',
                'codigo' => 'INT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Arma de Fuego',
                'codigo' => 'ARF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Arma Blanca',
                'codigo' => 'ARB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Precipitación',
                'codigo' => 'PRE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Electrocución',
                'codigo' => 'ELE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Otros',
                'codigo' => 'OTO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
