<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipos de alerta y novedades existentes
        $tiposAlerta = DB::table('tipo_alertas')->pluck('id')->toArray();
        $novedades = DB::table('novedades')->pluck('id')->toArray();
        
        if (empty($tiposAlerta)) {
            $this->command->warn('No hay tipos de alerta disponibles. Ejecute TipoAlertasSeeder primero.');
            return;
        }

        if (empty($novedades)) {
            $this->command->warn('No hay novedades disponibles. Ejecute NovedadesSeeder primero.');
            return;
        }

        DB::table('alertas')->insert([
            [
                'id' => 1,
                'tipo_alerta_id' => $tiposAlerta[0], // Paradero y ubicación - NIÑOS
                'novedad_id' => $novedades[0], // Robo en vía pública
                'titulo' => 'Alerta de Seguridad - Niños',
                'descripcion' => 'Se reporta actividad sospechosa en la zona. Mantener a los niños bajo supervisión.',
                'fecha_hora_envio' => now(),
                'enviada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'tipo_alerta_id' => $tiposAlerta[2], // Siniestro vial con victima fatal
                'novedad_id' => $novedades[1], // Accidente de tránsito
                'titulo' => 'Alerta de Tránsito',
                'descripcion' => 'Accidente vial en Ruta 16 Km 25. Evitar la zona y usar rutas alternativas.',
                'fecha_hora_envio' => now(),
                'enviada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'tipo_alerta_id' => $tiposAlerta[8], // Testing Purpose
                'novedad_id' => null, // Sin novedad específica
                'titulo' => 'Alerta de Prueba',
                'descripcion' => 'Esta es una alerta de prueba para verificar el funcionamiento del sistema.',
                'fecha_hora_envio' => now(),
                'enviada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
