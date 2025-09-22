<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cargador_id = 1;
        $visor_id = 2;
        $admin_id = 3;

        DB::table('permisos_roles')->insert([
            [
                'id' => 1,
                'permiso_id' => 1,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'permiso_id' => 3,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'permiso_id' => 2,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 4,
                'permiso_id' => 2,
                'rol_id' => $visor_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 5,
                'permiso_id' => 1,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 6,
                'permiso_id' => 2,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 7,
                'permiso_id' => 3,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 8,
                'permiso_id' => 4,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 9,
                'permiso_id' => 4,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 10,
                'permiso_id' => 5,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 11,
                'permiso_id' => 6,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 12,
                'permiso_id' => 5,
                'rol_id' => $visor_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 13,
                'permiso_id' => 6,
                'rol_id' => $visor_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 14,
                'permiso_id' => 5,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 15,
                'permiso_id' => 6,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 16,
                'permiso_id' => 7,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 17,
                'permiso_id' => 7,
                'rol_id' => $visor_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 18,
                'permiso_id' => 7,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 19,
                'permiso_id' => 8,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 20,
                'permiso_id' => 8,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 21,
                'permiso_id' => 9,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 22,
                'permiso_id' => 9,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 23,
                'permiso_id' => 10,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 24,
                'permiso_id' => 10,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 25,
                'permiso_id' => 11,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 26,
                'permiso_id' => 11,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 27,
                'permiso_id' => 12,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 28,
                'permiso_id' => 12,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 29,
                'permiso_id' => 13,
                'rol_id' => $admin_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 30,
                'permiso_id' => 13,
                'rol_id' => $cargador_id,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
        ]);
    }
}
