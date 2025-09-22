<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_personas')->insert([
            [
                'id' => 1,
                'nombre' => 'Física',
                'codigo_sat' => 1,
                'codigo_snic' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Jurídica',
                'codigo_sat' => 2,
                'codigo_snic' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
