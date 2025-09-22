<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionesClimaticasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('condicion_climaticas')->insert([
            [
                'id' => 1,
                'nombre' => 'Soleado',
                'codigo' => 'SOL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Nublado',
                'codigo' => 'NUB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Lluvia',
                'codigo' => 'LLU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Niebla',
                'codigo' => 'NIE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Viento',
                'codigo' => 'VIN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Granizo',
                'codigo' => 'GRA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
