<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiscalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fiscales')->insert([
            [
                'id' => 1,
                'nombre' => 'Dr. Juan',
                'apellido' => 'Pérez',
                'dni' => '25000001',
                'telefono' => '3854001001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Dra. María',
                'apellido' => 'González',
                'dni' => '25000002',
                'telefono' => '3854001002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Dr. Carlos',
                'apellido' => 'Rodríguez',
                'dni' => '25000003',
                'telefono' => '3854001003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
