<?php

namespace Database\Seeders;

use App\Models\TipoSiniestro;
use Illuminate\Database\Seeder;

class TipoSiniestrosSeeder extends Seeder
{

    public function run(): void
    {
        TipoSiniestro::create([
            'nombre' => 'COLISION VEHICULO - PERSONA',
            'codigo_sat' => '1',
        ]);

        TipoSiniestro::create([
            'nombre' => 'COLISION VEHICULO - VEHICULO',
            'codigo_sat' => '2',
        ]);

        TipoSiniestro::create([
            'nombre' => 'COLISION VEHICULO - OBJETO',
            'codigo_sat' => '3',
        ]);

        TipoSiniestro::create([
            'nombre' => 'VUELCO / DESPISTES',
            'codigo_sat' => '4',
        ]);

        TipoSiniestro::create([
            'nombre' => 'OTRO MODO (ESPECIFICAR)',
            'codigo_sat' => '5',
        ]);

        TipoSiniestro::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo_sat' => '99',
        ]);
    }
}
