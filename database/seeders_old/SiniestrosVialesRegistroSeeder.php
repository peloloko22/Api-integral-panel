<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiniestrosVialesRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $registros = DB::table('registros')->pluck('id')->toArray();
        $tiposSiniestro = DB::table('tipo_siniestros')->pluck('id')->toArray();
        $semaforos = DB::table('semaforo_siniestros')->pluck('id')->toArray();
        $condicionesClimaticas = DB::table('condicion_climaticas')->pluck('id')->toArray();
        
        if (empty($registros)) {
            $this->command->warn('No hay registros disponibles. Ejecute RegistrosSeeder primero.');
            return;
        }

        if (empty($tiposSiniestro)) {
            $this->command->warn('No hay tipos de siniestro disponibles. Ejecute TipoSiniestrosSeeder primero.');
            return;
        }

        if (empty($semaforos)) {
            $this->command->warn('No hay semáforos disponibles. Ejecute SemaforoSiniestrosSeeder primero.');
            return;
        }

        if (empty($condicionesClimaticas)) {
            $this->command->warn('No hay condiciones climáticas disponibles. Ejecute CondicionesClimaticasSeeder primero.');
            return;
        }

        DB::table('siniestro_vial_registros')->insert([
            [
                'id' => 1,
                'registro_id' => $registros[0], // Registro de robo
                'tipo_siniestro_id' => $tiposSiniestro[0], // Colisión Frontal
                'fuga' => false,
                'alcohol' => false,
                'semaforo_siniestro_id' => $semaforos[3], // Sin Semáforo
                'condicion_climatica_id' => $condicionesClimaticas[0], // Soleado
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'registro_id' => $registros[1], // Registro de hurto
                'tipo_siniestro_id' => $tiposSiniestro[2], // Colisión Trasera
                'fuga' => true,
                'alcohol' => true,
                'semaforo_siniestro_id' => $semaforos[2], // Rojo
                'condicion_climatica_id' => $condicionesClimaticas[2], // Lluvia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'registro_id' => $registros[2], // Registro de daños
                'tipo_siniestro_id' => $tiposSiniestro[4], // Atropello
                'fuga' => false,
                'alcohol' => false,
                'semaforo_siniestro_id' => $semaforos[1], // Amarillo
                'condicion_climatica_id' => $condicionesClimaticas[1], // Nublado
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
