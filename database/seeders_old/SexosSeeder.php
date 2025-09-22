<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sexos')->insert([
            [
                'id' => 1,
                'nombre' => 'Masculino',
                'descripcion' => NULL,
                'codigo_sat' => '1',
                'codigo_snic' => '1',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'nombre' => 'Femenino',
                'descripcion' => NULL,
                'codigo_sat' => '2',
                'codigo_snic' => '2',
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'nombre' => 'Sin determinar',
                'descripcion' => NULL,
                'codigo_sat' => '99',
                'codigo_snic' => '99',
                'created_at' => NULL,
                'updated_at' => NULL
            ]
        ]);
    }
}
