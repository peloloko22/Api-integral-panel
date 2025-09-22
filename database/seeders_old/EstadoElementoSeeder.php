<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // estados policiales de elemento
        DB::table('estado_elementos')->insert([
            [
                "id"=>1,
                "nombre"=> "Secuestrado",
                "codigo_sat"=>1,
                "codigo_snic"=>1
            ],
            [
                "id"=>2,
                "nombre"=> "Recuperado",
                "codigo_sat"=>2,
                "codigo_snic"=>2
            ],
            [
                "id"=>3,
                "nombre"=> "Dañado",
                "codigo_sat"=>3,
                "codigo_snic"=>3
            ],
            [
                "id"=>4,
                "nombre"=> "Destruido",
                "codigo_sat"=>4,
                "codigo_snic"=>4
            ],
        ]);
    }
}
