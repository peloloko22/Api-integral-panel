<?php

namespace Database\Seeders;

use App\Models\TipoVehiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoVehiculoSeeder extends Seeder
{

    public function run(): void
    {
        TipoVehiculo::create([
            'nombre' => 'Micro LARGA DISTANCIA',
            'codigo_sat' => '1',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Colectivo',
            'codigo_sat' => '2',
        ]); 
        TipoVehiculo::create([
            'nombre' => 'Camión',
            'codigo_sat' => '3',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Camioneta',
            'codigo_sat' => '4',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Automovil',
            'codigo_sat' => '5',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Motocicleta',
            'codigo_sat' => '6',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Ciclomotor',
            'codigo_sat' => '7',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Bicicleta',
            'codigo_sat' => '8',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Tren',
            'codigo_sat' => '9',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Otro',
            'codigo_sat' => '10',
        ]);
        TipoVehiculo::create([
            'nombre' => 'Sin Determinar',
            'codigo_sat' => '99',
        ]);
    }
}
