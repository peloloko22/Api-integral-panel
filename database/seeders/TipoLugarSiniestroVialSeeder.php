<?php

namespace Database\Seeders;

use App\Models\TipoLugarSiniestroVial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoLugarSiniestroVialSeeder extends Seeder
{
    /**
CALLE 	1
RUTA NACIONAL	2
RUTA PROVINCIAL 	3
AUTOPISTA NACIONAL 	4
AUTOPISTA PROVINCIAL 	5
AUTOVIA 	6
SIN DETERMINAR 	99
     */
    public function run(): void
    {
        TipoLugarSiniestroVial::create([
            'nombre' => 'CALLE',
            'codigo_sat' => '1',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'RUTA NACIONAL',
            'codigo_sat' => '2',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'RUTA PROVINCIAL',
            'codigo_sat' => '3',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'AUTOPISTA NACIONAL',
            'codigo_sat' => '4',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'AUTOPISTA PROVINCIAL',
            'codigo_sat' => '5',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'AUTOVIA',
            'codigo_sat' => '6',
        ]);
        TipoLugarSiniestroVial::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo_sat' => '99',
        ]);
    }
}
