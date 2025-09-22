<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_elementos')->insert([
            [
                'id' => 1,
                'nombre' => 'Arma de Fuego',
                "codigo_sat"=>1,
                "codigo_snic"=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Arma Blanca',
                "codigo_sat"=>2,
                "codigo_snic"=>2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Documento',
                "codigo_sat"=>3,
                "codigo_snic"=>3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Electrónico',
                "codigo_sat"=>4,
                "codigo_snic"=>4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Vehículo',
                "codigo_sat"=>5,
                "codigo_snic"=>5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Dinero',
                "codigo_sat"=>6,
                "codigo_snic"=>6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Droga',
                "codigo_sat"=>7,
                "codigo_snic"=>7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'Otros',
                "codigo_sat"=>8,
                "codigo_snic"=>8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
