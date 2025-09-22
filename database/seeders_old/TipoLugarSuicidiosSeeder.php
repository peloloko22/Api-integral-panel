<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoLugarSuicidiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_lugar_suicidios')->insert([
            [
                'id' => 1,
                'nombre' => 'Domicilio',
                'codigo' => 'DOM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Vía Pública',
                'codigo' => 'VIA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Hotel',
                'codigo' => 'HOT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Hospital',
                'codigo' => 'HOS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Establecimiento',
                'codigo' => 'EST',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Terreno Baldío',
                'codigo' => 'TER',
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
