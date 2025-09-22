<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipos de vehículo existentes
        $tiposVehiculo = DB::table('tipo_vehiculos')->pluck('id')->toArray();
        
        if (empty($tiposVehiculo)) {
            $this->command->warn('No hay tipos de vehículo disponibles. Ejecute TipoVehiculosSeeder primero.');
            return;
        }

        DB::table('vehiculos')->insert([
            [
                'id' => 1,
                'dominio' => 'ABC123',
                'tipo_vehiculo_id' => $tiposVehiculo[0], // Automóvil
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'color' => 'Blanco',
                'numero_motor' => 'MOT001',
                'numero_chasis' => 'CHA001',
                'extra' => 'Aire acondicionado, dirección hidráulica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'dominio' => 'XYZ789',
                'tipo_vehiculo_id' => $tiposVehiculo[1], // Camioneta
                'marca' => 'Ford',
                'modelo' => 'Ranger',
                'color' => 'Negro',
                'numero_motor' => 'MOT002',
                'numero_chasis' => 'CHA002',
                'extra' => 'Doble cabina, 4x4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'dominio' => 'DEF456',
                'tipo_vehiculo_id' => $tiposVehiculo[4], // Motocicleta
                'marca' => 'Honda',
                'modelo' => 'CG 150',
                'color' => 'Rojo',
                'numero_motor' => 'MOT003',
                'numero_chasis' => 'CHA003',
                'extra' => 'Casco incluido',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'dominio' => 'GHI789',
                'tipo_vehiculo_id' => $tiposVehiculo[2], // Camión
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Actros',
                'color' => 'Azul',
                'numero_motor' => 'MOT004',
                'numero_chasis' => 'CHA004',
                'extra' => 'Cabina alta, refrigerado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'dominio' => 'JKL012',
                'tipo_vehiculo_id' => $tiposVehiculo[5], // Bicicleta
                'marca' => 'Trek',
                'modelo' => 'Mountain Bike',
                'color' => 'Verde',
                'numero_motor' => null,
                'numero_chasis' => 'CHA005',
                'extra' => 'Suspensión delantera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
