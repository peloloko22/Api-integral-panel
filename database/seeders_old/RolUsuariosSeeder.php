<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol_usuarios')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'rol_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 2,
                'user_id' => 6,
                'rol_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'rol_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL
            ]
        ]);
    }
}
