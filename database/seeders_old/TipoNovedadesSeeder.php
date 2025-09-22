<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoNovedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_novedades')->insert([
            [
                'id' => 1,
                'nombre' => 'A Establecer',
                'prioridad' => 10,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:50:16',
                'updated_at' => '2025-06-23 16:50:16'
            ],
            [
                'id' => 2,
                'nombre' => 'Herido de Arma de Fuego',
                'prioridad' => 5,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:51:30',
                'updated_at' => '2025-06-23 16:51:30'
            ],
            [
                'id' => 3,
                'nombre' => 'Herido de Arma Blanca',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:51:45',
                'updated_at' => '2025-06-23 16:51:45'
            ],
            [
                'id' => 4,
                'nombre' => 'Hurto',
                'prioridad' => 8,
                'color' => '#133A55',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:52:09',
                'updated_at' => '2025-06-23 16:52:09'
            ],
            [
                'id' => 5,
                'nombre' => 'Robo en establecimiento educativo',
                'prioridad' => 3,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:52:53',
                'updated_at' => '2025-06-23 16:52:53'
            ],
            [
                'id' => 6,
                'nombre' => 'Suicidio',
                'prioridad' => 2,
                'color' => '#3498DB',
                'tipo_alerta_id' => 6,
                'created_at' => '2025-06-23 16:53:21',
                'updated_at' => '2025-06-23 16:53:21'
            ],
            [
                'id' => 7,
                'nombre' => 'Intento de Suicidio',
                'prioridad' => 5,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 16:53:37',
                'updated_at' => '2025-06-23 16:53:37'
            ],
            [
                'id' => 8,
                'nombre' => 'Siniestro vial con lesionado',
                'prioridad' => 5,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:01:18',
                'updated_at' => '2025-06-23 17:01:18'
            ],
            [
                'id' => 9,
                'nombre' => 'Siniestro vial con daños materiales',
                'prioridad' => 5,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:01:43',
                'updated_at' => '2025-06-23 17:01:43'
            ],
            [
                'id' => 10,
                'nombre' => 'Amenazas',
                'prioridad' => 8,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:02:23',
                'updated_at' => '2025-06-23 17:02:23'
            ],
            [
                'id' => 11,
                'nombre' => 'Amenazas Calificadas',
                'prioridad' => 8,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:02:39',
                'updated_at' => '2025-06-23 17:02:39'
            ],
            [
                'id' => 12,
                'nombre' => 'Quema de Pastizales',
                'prioridad' => 9,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:03:05',
                'updated_at' => '2025-06-23 17:03:05'
            ],
            [
                'id' => 13,
                'nombre' => 'Paradero y Ubicación - Niños',
                'prioridad' => 1,
                'color' => '#3498DB',
                'tipo_alerta_id' => 1,
                'created_at' => '2025-06-23 17:04:10',
                'updated_at' => '2025-06-23 17:04:10'
            ],
            [
                'id' => 14,
                'nombre' => 'Paradero y Ubicación - Mayores',
                'prioridad' => 1,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:04:28',
                'updated_at' => '2025-06-23 17:04:28'
            ],
            [
                'id' => 15,
                'nombre' => 'Paradero y Ubicación - Adolescentes',
                'prioridad' => 1,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:04:44',
                'updated_at' => '2025-06-23 17:04:44'
            ],
            [
                'id' => 16,
                'nombre' => 'Robo Calificado',
                'prioridad' => 3,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:05:09',
                'updated_at' => '2025-06-23 17:05:09'
            ],
            [
                'id' => 17,
                'nombre' => 'Foco igneo',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:05:40',
                'updated_at' => '2025-06-23 17:05:40'
            ],
            [
                'id' => 18,
                'nombre' => 'Lesiones Calificadas',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:06:37',
                'updated_at' => '2025-06-23 17:06:37'
            ],
            [
                'id' => 19,
                'nombre' => 'Daños',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:06:54',
                'updated_at' => '2025-06-23 17:06:54'
            ],
            [
                'id' => 20,
                'nombre' => 'Robo (Arrebato)',
                'prioridad' => 3,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:09:55',
                'updated_at' => '2025-06-23 17:09:55'
            ],
            [
                'id' => 21,
                'nombre' => 'Abigeato',
                'prioridad' => 9,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:10:10',
                'updated_at' => '2025-06-23 17:10:10'
            ],
            [
                'id' => 22,
                'nombre' => 'Robo',
                'prioridad' => 3,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:15:45',
                'updated_at' => '2025-06-23 17:15:45'
            ],
            [
                'id' => 23,
                'nombre' => 'Masculino Aprehendido',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 17:17:31',
                'updated_at' => '2025-06-23 17:17:31'
            ],
            [
                'id' => 24,
                'nombre' => 'Persona por habido',
                'prioridad' => 6,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 18:32:07',
                'updated_at' => '2025-06-23 18:32:07'
            ],
            [
                'id' => 25,
                'nombre' => 'Lesiones',
                'prioridad' => 9,
                'color' => '#3498DB',
                'tipo_alerta_id' => NULL,
                'created_at' => '2025-06-23 18:32:53',
                'updated_at' => '2025-06-23 18:32:53'
            ]
        ]);
    }
}
