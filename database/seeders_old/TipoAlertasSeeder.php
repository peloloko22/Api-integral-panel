<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAlertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_alertas')->insert([
            [
                'id' => 1,
                'nombre' => 'Paradero y ubicación - NIÑOS',
                'descripcion' => '-',
                'created_at' => '2025-06-17 17:20:16',
                'updated_at' => '2025-06-17 17:20:16'
            ],
            [
                'id' => 4,
                'nombre' => 'Homicidios',
                'descripcion' => '-',
                'created_at' => '2025-06-17 17:21:13',
                'updated_at' => '2025-06-17 17:21:13'
            ],
            [
                'id' => 5,
                'nombre' => 'Siniestro vial con victima fatal',
                'descripcion' => '-',
                'created_at' => '2025-06-17 17:22:39',
                'updated_at' => '2025-06-17 17:22:39'
            ],
            [
                'id' => 6,
                'nombre' => 'Suicidio',
                'descripcion' => '-',
                'created_at' => '2025-06-17 17:22:47',
                'updated_at' => '2025-06-17 17:22:47'
            ],
            [
                'id' => 7,
                'nombre' => 'Robo de vehiculo',
                'descripcion' => '-',
                'created_at' => '2025-06-17 17:23:24',
                'updated_at' => '2025-06-17 17:23:24'
            ],
            [
                'id' => 9,
                'nombre' => 'Testing Purpose',
                'descripcion' => '----- SOLO PARA TESTING --------',
                'created_at' => '2025-06-24 19:43:20',
                'updated_at' => '2025-06-24 19:43:20'
            ],
            [
                'id' => 10,
                'nombre' => 'Paradero y ubicacion - MAYORES',
                'descripcion' => NULL,
                'created_at' => '2025-06-26 08:32:04',
                'updated_at' => '2025-06-26 08:32:04'
            ],
            [
                'id' => 11,
                'nombre' => 'Paradero y ubicacion - ADOLECENTES',
                'descripcion' => NULL,
                'created_at' => '2025-06-26 08:32:29',
                'updated_at' => '2025-06-26 08:32:29'
            ]
        ]);
    }
}
