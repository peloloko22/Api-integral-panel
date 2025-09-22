<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generos')->insert([
            [
                'id' => 1,
                'nombre' => 'Masculino',
                'codigo_sat' => '1',
                'codigo_snic' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Femenino',
                'codigo_sat' => '2',
                'codigo_snic' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'No Binario',
                'codigo_sat' => '99',
                'codigo_snic' => '99',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Otros',
                'codigo_sat' => '100',
                'codigo_snic' => '100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
