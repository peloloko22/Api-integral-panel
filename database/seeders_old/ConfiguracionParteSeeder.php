<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionParteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configuracion_partes')->insert([
            'hora_inicio' => '05:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
