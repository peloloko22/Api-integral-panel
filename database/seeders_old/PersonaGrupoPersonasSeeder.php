<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaGrupoPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('persona_grupo_personas')->insert([
            'persona_id' => 1, // Admin user (ID 1)
            'grupo_persona_id' => 1, // Testing group
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
