<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class VehiculoNoIdentificableSeeder extends Seeder
{

    public function run(): void
    {
        
        Vehiculo::create([
            'dominio' => '--MOT',
            'no_identificable' => true,
            'no_identificable_nombre' => 'Motocicleta',
            'pedido_captura' => false,
        ]);
        
        Vehiculo::create([
            'dominio' => '--AUTO',
            'no_identificable' => true,
            'no_identificable_nombre' => 'Automovil',
            'pedido_captura' => false,
        ]);

        Vehiculo::create([
            'dominio' => '--BIC',
            'no_identificable' => true,
            'no_identificable_nombre' => 'Bicicleta',
            'pedido_captura' => false,
        ]);

        Vehiculo::create([
            'dominio' => '--CAM',
            'no_identificable' => true,
            'no_identificable_nombre' => 'Camión',
            'pedido_captura' => false,
        ]);
        
        Vehiculo::create([
            'dominio' => '--VUT',
            'no_identificable' => true,
            'no_identificable_nombre' => 'Vehículo utilitario',
            'pedido_captura' => false,
        ]);

        Vehiculo::create([
            'dominio' => '--TRA',
            'no_identificable' => true,
            'no_identificable_nombre' => 'TRACCION A SANGRE',
            'pedido_captura' => false,
        ]);
    }
}
