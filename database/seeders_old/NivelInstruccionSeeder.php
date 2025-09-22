<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelInstruccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nivel_instrucciones')->insert([
            [
                'id' => 1,
                'nombre' => 'Sin Instrucción',
                'descripcion' => 'Persona sin ningún tipo de instrucción formal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Primaria Incompleta',
                'descripcion' => 'Primaria no finalizada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Primaria Completa',
                'descripcion' => 'Primaria finalizada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Secundaria Incompleta',
                'descripcion' => 'Secundaria no finalizada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Secundaria Completa',
                'descripcion' => 'Secundaria finalizada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'Terciario Incompleto',
                'descripcion' => 'Estudios terciarios no finalizados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'Terciario Completo',
                'descripcion' => 'Estudios terciarios finalizados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'Universitario Incompleto',
                'descripcion' => 'Estudios universitarios no finalizados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nombre' => 'Universitario Completo',
                'descripcion' => 'Estudios universitarios finalizados',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'nombre' => 'Posgrado',
                'descripcion' => 'Estudios de posgrado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
