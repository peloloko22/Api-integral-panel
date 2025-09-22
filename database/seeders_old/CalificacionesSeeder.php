<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calificaciones = [
            ['codigo_sat' => '201', 'codigo_snic' => '201', 'nombre' => 'En poblado y en banda'],
            ['codigo_sat' => '202', 'codigo_snic' => '202', 'nombre' => 'Con lesiones graves'],
            ['codigo_sat' => '203', 'codigo_snic' => '203', 'nombre' => 'Con lesiones leves'],
            ['codigo_sat' => '204', 'codigo_snic' => '204', 'nombre' => 'Con uso de arma de fuego'],
            ['codigo_sat' => '205', 'codigo_snic' => '205', 'nombre' => 'Con uso de arma blanca'],
            ['codigo_sat' => '206', 'codigo_snic' => '206', 'nombre' => 'Con uso de arma impropia'],
            ['codigo_sat' => '207', 'codigo_snic' => '207', 'nombre' => 'En lugar despoblado'],
            ['codigo_sat' => '208', 'codigo_snic' => '208', 'nombre' => 'En ocasión de espectáculo deportivo'],
            ['codigo_sat' => '209', 'codigo_snic' => '209', 'nombre' => 'Con abuso de autoridad'],
            ['codigo_sat' => '210', 'codigo_snic' => '210', 'nombre' => 'Contra menores'],
            ['codigo_sat' => '211', 'codigo_snic' => '211', 'nombre' => 'Contra adultos mayores'],
            ['codigo_sat' => '212', 'codigo_snic' => '212', 'nombre' => 'Contra personas con discapacidad'],
            ['codigo_sat' => '213', 'codigo_snic' => '213', 'nombre' => 'Con intrusión domiciliaria'],
            ['codigo_sat' => '214', 'codigo_snic' => '214', 'nombre' => 'Contra transporte público'],
            ['codigo_sat' => '215', 'codigo_snic' => '215', 'nombre' => 'Con escalamiento'],
            ['codigo_sat' => '216', 'codigo_snic' => '216', 'nombre' => 'Con fuerza en las cosas'],
            ['codigo_sat' => '217', 'codigo_snic' => '217', 'nombre' => 'Con aprovechamiento de calamidad pública'],
            ['codigo_sat' => '218', 'codigo_snic' => '218', 'nombre' => 'Con engaño o ardid'],
            ['codigo_sat' => '219', 'codigo_snic' => '219', 'nombre' => 'Con abuso de confianza'],
            ['codigo_sat' => '220', 'codigo_snic' => '220', 'nombre' => 'Con uso de uniforme policial o militar'],
        ];

        foreach ($calificaciones as $calificacion) {
            DB::table('calificacion_hechos')->insert([
                'codigo_sat' => $calificacion['codigo_sat'],
                'codigo_snic' => $calificacion['codigo_snic'],
                'nombre' => $calificacion['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
