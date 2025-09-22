<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grupo_personas')->insert([
            'id' => 1,
            'nombre' => 'Grupo Testing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
