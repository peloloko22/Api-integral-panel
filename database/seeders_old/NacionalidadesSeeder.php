<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacionalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nacionalidades')->insert([
            [
                'id' => 1,
                'nombre' => 'Argentina',
                'codigo_sat' => 'ARG',
                'codigo_snic' => 'ARG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Bolivia',
                'codigo_sat' => 'BOL',
                'codigo_snic' => 'BOL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Brasil',
                'codigo_sat' => 'BRA',
                'codigo_snic' => 'BRA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Chile',
                'codigo_sat' => 'CHL',
                'codigo_snic' => 'CHL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Paraguay',
                'codigo_sat' => 'PRY',
                'codigo_snic' => 'PRY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Uruguay',
                'codigo_sat' => 'URY',
                'codigo_snic' => 'URY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Perú',
                'codigo_sat' => 'PER',
                'codigo_snic' => 'PER',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'Colombia',
                'codigo_sat' => 'COL',
                'codigo_snic' => 'COL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nombre' => 'Venezuela',
                'codigo_sat' => 'VEN',
                'codigo_snic' => 'VEN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'nombre' => 'Ecuador',
                'codigo_sat' => 'ECU',
                'codigo_snic' => 'ECU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'nombre' => 'Estados Unidos',
                'codigo_sat' => 'USA',
                'codigo_snic' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'nombre' => 'España',
                'codigo_sat' => 'ESP',
                'codigo_snic' => 'ESP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'nombre' => 'Italia',
                'codigo_sat' => 'ITA',
                'codigo_snic'=> "ITA",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'nombre' => 'Otros',
                'codigo_sat' => 'OTR',
                'codigo_snic' => 'OTR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
