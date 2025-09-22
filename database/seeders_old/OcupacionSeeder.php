<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OcupacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('ocupaciones')->insert([
            [
                'id' => 1,
                'nombre' => 'Desocupado',
                'codigo_sat' => 1,
                'codigo_snic' => 1,
            ],
            [
                'id' => 2,
                'nombre' => 'Jubilado/Pensionado',
                'codigo_sat' => 2,
                'codigo_snic' => 2,
            ],
            [
                'id' => 3,
                'nombre' => 'Rentista',
                'codigo_sat' => 3,
                'codigo_snic' => 3,
            ],
            [
                'id' => 4,
                'nombre' => 'Estudiante',
                'codigo_sat' => 4,
                'codigo_snic' => 4,
            ],
            [
                'id' => 5,
                'nombre' => 'Ama de casa',
                'codigo_sat' => 5,
                'codigo_snic' => 5,
            ],
            [
                'id' => 6,
                'nombre' => 'Empleado de medios de comunicacion',
                'codigo_sat' => 6,
                'codigo_snic' => 6,
            ],
            [
                'id' => 7,
                'nombre' => 'Empleado de otros sectores',
                'codigo_sat' => 7,
                'codigo_snic' => 7,
            ],
            [
                'id' => 8,
                'nombre' => 'Trabajador cuenta propia',
                'codigo_sat' => 8,
                'codigo_snic' => 8,
            ],
            [
                'id' => 9,
                'nombre' => 'Changarin',
                'codigo_sat' => 9,
                'codigo_snic' => 9,
            ],
            [
                'id' => 10,
                'nombre' => 'Patron/Empleado',
                'codigo_sat' => 10,
                'codigo_snic' => 10,
            ],
            [
                'id' => 11,
                'nombre' => 'Trabajador/a sexual',
                'codigo_sat' => 11,
                'codigo_snic' => 11,
            ],
            [
                'id' => 12,
                'nombre' => 'Representante sindical',
                'codigo_sat' => 12,
                'codigo_snic' => 12,
            ],
            [
                'id' => 13,
                'nombre' => 'Activista de DDHH',
                'codigo_sat' => 13,
                'codigo_snic' => 13,
            ],
            [
                'id' => 14,
                'nombre' => 'Otro (especificar)',
                'codigo_sat' => 14,
                'codigo_snic' => 14,
            ],
            [
                'id' => 15,
                'nombre' => 'Sin determinar',
                'codigo_sat' => 99,
                'codigo_snic' => 99,
            ],
        ]);
    }
}
