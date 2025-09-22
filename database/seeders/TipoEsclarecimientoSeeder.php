<?php

namespace Database\Seeders;

use App\Models\TipoEsclarecimientoHecho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEsclarecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido con aprehensión',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido con imputación',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido con secuestro de elementos',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido parcialmente',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido por confesión',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido por pericia',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Esclarecido por mediación / acuerdo',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'No esclarecido / en investigación',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Hecho inexistente / denuncia falsa',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Prescripto',
        ]);
        TipoEsclarecimientoHecho::create([
            'nombre' => 'Sin determinar',
        ]);
    }
}
