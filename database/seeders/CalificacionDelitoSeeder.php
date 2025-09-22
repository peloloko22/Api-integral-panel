<?php

namespace Database\Seeders;

use App\Models\CalificacionHecho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalificacionDelitoSeeder extends Seeder
{
    
    public function run(): void
    {
        CalificacionHecho::create([
            'nombre' => 'Simple',

            'codigo_snic' => '1',
            'codigo_sat' => '1',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Calificada',
            'codigo_snic' => '2',
            'codigo_sat' => '2',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Agravado',
            'codigo_snic' => '3',
            'codigo_sat' => '3',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Emocion Violenta',
            'codigo_snic' => '4',
            'codigo_sat' => '4',
        ]);
        CalificacionHecho::create([
            'nombre' => 'En Riña',
            'codigo_snic' => '5',
            'codigo_sat' => '5',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Homicio Preterintencional',
            'codigo_snic' => '6',
            'codigo_sat' => '6',
        ]);
        CalificacionHecho::create([
            'nombre' => 'En Resultado de Abuso Sexual',
            'codigo_snic' => '7',
            'codigo_sat' => '7',
        ]);
        CalificacionHecho::create([
            'nombre' => 'En Defensa Propia o Terceros',
            'codigo_snic' => '8',
            'codigo_sat' => '8',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Robo Agravado por Homicio',
            'codigo_snic' => '9',
            'codigo_sat' => '9',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Leves',
            'codigo_snic' => '10',
            'codigo_sat' => '10',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Graves',
            'codigo_snic' => '11',
            'codigo_sat' => '11',
        ]);
        CalificacionHecho::create([
            'nombre' => 'Gravisima',
            'codigo_snic' => '12',
            'codigo_sat' => '12',
        ]);
    
    }
}
