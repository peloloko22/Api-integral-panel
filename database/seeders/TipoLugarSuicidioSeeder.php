<?php

namespace Database\Seeders;

use App\Models\TipoLugarSuicidio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoLugarSuicidioSeeder extends Seeder
{
/* VIA PUBLICA 	1
DOMICILIO PARTICULAR	2
VIAS DEL FF. CC. 	3
CARCEL O COMISARIA	4
OTRO LUGAR (ESPECIFICAR)	5
SIN DETERMINAR 	99 */
    public function run(): void
    {
        TipoLugarSuicidio::create([
            'nombre' => 'Via publica',
            'codigo' => '1',
        ]);
        TipoLugarSuicidio::create([
            'nombre' => 'Domicilio particular',
            'codigo' => '2',
        ]);
        TipoLugarSuicidio::create([
            'nombre' => 'Vias del ff. cc.',
            'codigo' => '3',
        ]);
        TipoLugarSuicidio::create([
            'nombre' => 'Carcel o comisaria',
            'codigo' => '4',
        ]);
        TipoLugarSuicidio::create([
            'nombre' => 'Otro lugar (especificar)',
            'codigo' => '5',
        ]);
        TipoLugarSuicidio::create([
            'nombre' => 'Sin determinar',
            'codigo' => '99',
        ]);
    }
}
