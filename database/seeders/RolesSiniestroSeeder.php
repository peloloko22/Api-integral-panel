<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSiniestroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol_siniestros')->insert([
            [
                'id' => 1,
                'nombre' => 'Conductor',
                'descripcion' => 'Persona que conduce el vehículo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Pasajero',
                'descripcion' => 'Persona que viaja como pasajero',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Peatón',
                'descripcion' => 'Persona que camina por la vía',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Ciclista',
                'descripcion' => 'Persona que circula en bicicleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Motociclista',
                'descripcion' => 'Persona que conduce motocicleta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Testigo',
                'descripcion' => 'Persona que presenció el siniestro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
