<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_vehiculos')->insert([
            [
                'id' => 1,
                'nombre' => 'Automóvil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Camioneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Camión',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Ómnibus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Motocicleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Bicicleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Tractor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'Otros',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
