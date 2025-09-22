<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantesSiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $siniestros = DB::table('siniestro_vial_registros')->pluck('id')->toArray();
        $personas = DB::table('personas')->pluck('id')->toArray();
        $vehiculos = DB::table('vehiculos')->pluck('id')->toArray();
        $rolesSiniestro = DB::table('rol_siniestros')->pluck('id')->toArray();
        
        if (empty($siniestros)) {
            $this->command->warn('No hay siniestros viales disponibles. Ejecute SiniestrosVialesRegistroSeeder primero.');
            return;
        }

        if (empty($personas)) {
            $this->command->warn('No hay personas disponibles. Ejecute PersonasSeeder primero.');
            return;
        }

        if (empty($vehiculos)) {
            $this->command->warn('No hay vehículos disponibles. Ejecute VehiculosSeeder primero.');
            return;
        }

        if (empty($rolesSiniestro)) {
            $this->command->warn('No hay roles de siniestro disponibles. Ejecute RolesSiniestroSeeder primero.');
            return;
        }

        DB::table('siniestro_novedad_participantes')->insert([
            [
                'id' => 1,
                'siniestro_id' => $siniestros[0], // Siniestro de colisión frontal
                'persona_id' => $personas[0], // Primera persona
                'vehiculo_id' => $vehiculos[0], // Automóvil Toyota
                'rol_siniestro_id' => $rolesSiniestro[0], // Conductor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'siniestro_id' => $siniestros[0], // Siniestro de colisión frontal
                'persona_id' => $personas[1], // Segunda persona
                'vehiculo_id' => $vehiculos[1], // Camioneta Ford
                'rol_siniestro_id' => $rolesSiniestro[0], // Conductor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'siniestro_id' => $siniestros[1], // Siniestro de colisión trasera
                'persona_id' => $personas[2], // Tercera persona
                'vehiculo_id' => $vehiculos[2], // Motocicleta Honda
                'rol_siniestro_id' => $rolesSiniestro[5], // Motociclista
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'siniestro_id' => $siniestros[2], // Siniestro de atropello
                'persona_id' => $personas[3], // Cuarta persona
                'vehiculo_id' => null, // Sin vehículo (peatón)
                'rol_siniestro_id' => $rolesSiniestro[2], // Peatón
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'siniestro_id' => $siniestros[2], // Siniestro de atropello
                'persona_id' => $personas[4], // Quinta persona
                'vehiculo_id' => $vehiculos[3], // Camión Mercedes
                'rol_siniestro_id' => $rolesSiniestro[0], // Conductor
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
