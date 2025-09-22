<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'nombre' => 'Cargador',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'nombre' => 'Visor',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'nombre' => 'Administrador',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ]
        ]);
    }
}
