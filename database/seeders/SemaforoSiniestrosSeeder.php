<?php

namespace Database\Seeders;

use App\Models\SemaforoSiniestro;
use Illuminate\Database\Seeder;

class SemaforoSiniestrosSeeder extends Seeder
{
   
    public function run(): void
    {

        SemaforoSiniestro::create([
            'nombre' => 'FUNCIONABA',
            'codigo' => '1',
        ]);

        SemaforoSiniestro::create([
            'nombre' => 'NO FUNCIONABA',
            'codigo' => '2',
        ]);

        SemaforoSiniestro::create([
            'nombre' => 'SIN SEMAFORO',
            'codigo' => '3',
        ]);

        SemaforoSiniestro::create([
            'nombre' => 'INTERMITENTE',
            'codigo' => '4',
        ]);

        SemaforoSiniestro::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo' => '99',
        ]);
    }
}
