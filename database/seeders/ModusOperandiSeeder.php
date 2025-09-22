<?php

namespace Database\Seeders;

use App\Models\ModusOperandi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModusOperandiSeeder extends Seeder
{
    
    public function run(): void
    {
        ModusOperandi::create([
            'nombre' => 'CON ARMA',
            'codigo_snic' => '1',
            'codigo_sat' => '1',
        ]);
        ModusOperandi::create([
            'nombre' => 'SIMPLE',
            'codigo_snic' => '2',
            'codigo_sat' => '2',
        ]);
        ModusOperandi::create([
            'nombre' => 'VIA PUBLICA',
            'codigo_snic' => '3',
            'codigo_sat' => '3',
        ]);
        ModusOperandi::create([
            'nombre' => 'EN CONTEXTO DE VIOLENCIA DE GENERO',
            'codigo_snic' => '4',
            'codigo_sat' => '4',
        ]);
        ModusOperandi::create([
            'nombre' => 'SIN ARMA',
            'codigo_snic' => '5',
            'codigo_sat' => '5',
        ]);
        ModusOperandi::create([
            'nombre' => 'ARREBATO',
            'codigo_snic' => '6',
            'codigo_sat' => '6',
        ]);
        ModusOperandi::create([
            'nombre' => 'ENTRADERA',
            'codigo_snic' => '7',
            'codigo_sat' => '7',
        ]);
        ModusOperandi::create([
            'nombre' => 'PIRAÑA',
            'codigo_snic' => '8',
            'codigo_sat' => '8',
        ]);
        ModusOperandi::create([
            'nombre' => 'PIRATA DEL ASFALTO',
            'codigo_snic' => '9',
            'codigo_sat' => '9',
        ]);
        ModusOperandi::create([
            'nombre' => 'ROMPE VIDRIO',
            'codigo_snic' => '10',
            'codigo_sat' => '10',
        ]);
        ModusOperandi::create([
            'nombre' => 'CON REHENES',
            'codigo_snic' => '11',
            'codigo_sat' => '11',
        ]);
        ModusOperandi::create([
            'nombre' => 'ROTURA DE PUERTA / VENTANA / PARED',
            'codigo_snic' => '12',
            'codigo_sat' => '12',
        ]);
        ModusOperandi::create([
            'nombre' => 'EN BANDA (ART. 166)',
            'codigo_snic' => '13',
            'codigo_sat' => '13',
        ]);
        ModusOperandi::create([
            'nombre' => 'ESCALAMIENTO',
            'codigo_snic' => '14',
            'codigo_sat' => '14',
        ]);
        ModusOperandi::create([
            'nombre' => 'USO DE LLAVES GANZUAS',
            'codigo_snic' => '15',
            'codigo_sat' => '15',
        ]);
        ModusOperandi::create([
            'nombre' => 'HORMIGA',
            'codigo_snic' => '16',
            'codigo_sat' => '16',
        ]);
        ModusOperandi::create([
            'nombre' => 'MECHERA',
            'codigo_snic' => '17',
            'codigo_sat' => '17',
        ]);
        ModusOperandi::create([
            'nombre' => 'OTROS',
            'codigo_snic' => '18',
            'codigo_sat' => '18',
        ]);
        ModusOperandi::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo_snic' => '19',
            'codigo_sat' => '19',
        ]);
    }
}
