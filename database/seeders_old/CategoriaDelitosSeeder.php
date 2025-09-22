<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaDelitosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_delitos')->insert([
            [
                'id' => 1,
                'codigo_sat' => '01',
                'codigo_snic' => '01',
                'nombre' => 'DELITOS GENERALES',
                'descripcion' => 'Categoría general para todos los delitos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
