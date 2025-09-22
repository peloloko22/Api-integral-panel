<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permisos')->insert([
            [
                'id' => 1,
                'nombre' => 'cargar_novedad',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'nombre' => 'ver_parte',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'nombre' => 'ver_novedades_nofilter',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 4,
                'nombre' => 'revisar_novedad',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 5,
                'nombre' => 'ver_alertas',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 6,
                'nombre' => 'crear_alerta',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 7,
                'nombre' => 'ver_detalles_alerta',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 8,
                'nombre' => 'ver_denuncias',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 9,
                'nombre' => 'crear_denuncia',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 10,
                'nombre' => 'ver_registros_estadisticos',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 11,
                'nombre' => 'crear_registro_estadistico',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 12,
                'nombre' => 'ver_detalles_registro',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 13,
                'nombre' => 'ver_detalles_denuncia',
                'descripcion' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
        ]);
    }
}
