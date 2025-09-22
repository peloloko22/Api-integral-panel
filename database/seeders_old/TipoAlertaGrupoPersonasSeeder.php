<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAlertaGrupoPersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_alerta_grupo_personas')->insert([
            'tipo_alerta_id' => 9, // Testing Purpose alert type
            'grupo_persona_id' => 1, // Testing group
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
