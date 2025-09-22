<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuicidiosRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $registros = DB::table('registros')->pluck('id')->toArray();
        $mecanismosSuicidio = DB::table('mecanismo_suicidios')->pluck('id')->toArray();
        $tiposLugarSuicidio = DB::table('tipo_lugar_suicidios')->pluck('id')->toArray();
        
        if (empty($registros)) {
            $this->command->warn('No hay registros disponibles. Ejecute RegistrosSeeder primero.');
            return;
        }

        if (empty($mecanismosSuicidio)) {
            $this->command->warn('No hay mecanismos de suicidio disponibles. Ejecute MecanismosSuicidioSeeder primero.');
            return;
        }

        if (empty($tiposLugarSuicidio)) {
            $this->command->warn('No hay tipos de lugar de suicidio disponibles. Ejecute TipoLugarSuicidiosSeeder primero.');
            return;
        }

        DB::table('suicidio_registros')->insert([
            [
                'id' => 1,
                'registro_id' => $registros[0], // Registro de robo
                'testigo_id' => null, // Sin testigo
                'suicida_id' => null, // Sin suicida específico
                'tipo_lugar_suicidio_id' => $tiposLugarSuicidio[1], // Vía Pública
                'mecanismo_suicidio_id' => $mecanismosSuicidio[0], // Ahorcamiento
                'descripcion' => 'Intento de suicidio por ahorcamiento en vía pública. Intervención policial exitosa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'registro_id' => $registros[1], // Registro de hurto
                'testigo_id' => null, // Sin testigo
                'suicida_id' => null, // Sin suicida específico
                'tipo_lugar_suicidio_id' => $tiposLugarSuicidio[0], // Domicilio
                'mecanismo_suicidio_id' => $mecanismosSuicidio[1], // Intoxicación
                'descripcion' => 'Suicidio por intoxicación en domicilio particular. Hallazgo por familiar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'registro_id' => $registros[2], // Registro de daños
                'testigo_id' => null, // Sin testigo
                'suicida_id' => null, // Sin suicida específico
                'tipo_lugar_suicidio_id' => $tiposLugarSuicidio[6], // Terreno Baldío
                'mecanismo_suicidio_id' => $mecanismosSuicidio[2], // Arma de Fuego
                'descripcion' => 'Suicidio por arma de fuego en terreno baldío. Reporte de vecinos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
