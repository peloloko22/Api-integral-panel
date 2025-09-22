<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertaJerarquiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipos de alerta y jerarquías existentes
        $tiposAlerta = DB::table('tipo_alertas')->pluck('id')->toArray();
        $jerarquias = DB::table('jerarquias')->pluck('id')->toArray();
        
        if (empty($tiposAlerta)) {
            $this->command->warn('No hay tipos de alerta disponibles. Ejecute TipoAlertasSeeder primero.');
            return;
        }

        if (empty($jerarquias)) {
            $this->command->warn('No hay jerarquías disponibles. Ejecute JerarquiasSeeder primero.');
            return;
        }

        DB::table('alerta_jerarquias')->insert([/* 
            [
                'tipo_alerta_id' => $tiposAlerta[0], // Paradero y ubicación - NIÑOS
                'jerarquia_id' => $jerarquias[0], // Comisario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta_id' => $tiposAlerta[1], // Homicidios
                'jerarquia_id' => $jerarquias[0], // Comisario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta_id' => $tiposAlerta[2], // Siniestro vial con victima fatal
                'jerarquia_id' => $jerarquias[1], // Subcomisario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta_id' => $tiposAlerta[3], // Suicidio
                'jerarquia_id' => $jerarquias[1], // Subcomisario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta_id' => $tiposAlerta[4], // Robo de vehiculo
                'jerarquia_id' => $jerarquias[2], // Oficial Principal
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta_id' => $tiposAlerta[8], // Testing Purpose
                'jerarquia_id' => $jerarquias[4], // Suboficial
                'created_at' => now(),
                'updated_at' => now(),
            ], */
        ]);
    }
}
