<?php

namespace Database\Seeders;

use App\Models\MecanismoArma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MecanismoArmaSeeder extends Seeder
{	
    public function run(): void
    {
        MecanismoArma::create([
            'nombre' => 'ARMA DE FUEGO',
            'codigo_snic' => '1',
            'codigo_sat' => '1',
        ]);
        MecanismoArma::create([
            'nombre' => 'ARMA DE BLANCA',
            'codigo_snic' => '2',
            'codigo_sat' => '2',
        ]);
        MecanismoArma::create([
            'nombre' => 'OTRA ARMA O MECANISMO (ESPECIFICAR)',
            'codigo_snic' => '3',
            'codigo_sat' => '3',
        ]);
        MecanismoArma::create([
            'nombre' => 'OBJETO CONTUNDENTE',
            'codigo_snic' => '5',
            'codigo_sat' => '5',
        ]);
        MecanismoArma::create([
            'nombre' => 'ARROLLAMIENTO POR RODADO O TREN',
            'codigo_snic' => '6',
            'codigo_sat' => '6',
        ]);
        MecanismoArma::create([
            'nombre' => 'GOLPES DE PUÑO',
            'codigo_snic' => '7',
            'codigo_sat' => '7',
        ]);
        MecanismoArma::create([
            'nombre' => 'AHORCAMIENTO / ASFIXIA',
            'codigo_snic' => '8',
            'codigo_sat' => '8',
        ]);
        MecanismoArma::create([
            'nombre' => 'ENVENENAMIENTO',
            'codigo_snic' => '9',
            'codigo_sat' => '9',
        ]);
        MecanismoArma::create([
            'nombre' => 'PRECIPITACION AL VACIO',
            'codigo_snic' => '10',
            'codigo_sat' => '10',
        ]);
        MecanismoArma::create([
            'nombre' => 'QUEMADURAS',
            'codigo_snic' => '11',
            'codigo_sat' => '11',
        ]);
        MecanismoArma::create([
            'nombre' => 'TUMBERAS',
            'codigo_snic' => '12',
            'codigo_sat' => '12',
        ]);
        MecanismoArma::create([
            'nombre' => 'SIN ARMA',
            'codigo_snic' => '13',
            'codigo_sat' => '13',
        ]);
        MecanismoArma::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo_snic' => '99',
            'codigo_sat' => '99',
        ]);

    }
}
