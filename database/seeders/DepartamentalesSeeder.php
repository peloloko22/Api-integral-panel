<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentales')->insert([
            ['id' => 4, 'nombre' => 'D.S.C. Nº1 - Norte', 'codigo' => '1', 'created_at' => '2025-06-25 08:16:38', 'updated_at' => '2025-06-25 08:16:38'],
            ['id' => 5, 'nombre' => 'D.S.C. Nº2 - Centro', 'codigo' => '2', 'created_at' => '2025-06-25 08:16:50', 'updated_at' => '2025-06-25 08:16:50'],
            ['id' => 6, 'nombre' => 'D.S.C. Nº3 - Sur', 'codigo' => '3', 'created_at' => '2025-06-25 08:17:04', 'updated_at' => '2025-06-25 08:17:04'],
            ['id' => 7, 'nombre' => 'D.S.C. Nº4 - Banda Oeste', 'codigo' => '4', 'created_at' => '2025-06-25 08:22:29', 'updated_at' => '2025-06-25 08:22:29'],
            ['id' => 8, 'nombre' => 'D.S.C. Nº5 - Banda Este', 'codigo' => '5', 'created_at' => '2025-06-25 08:22:43', 'updated_at' => '2025-06-25 08:22:43'],
            ['id' => 9, 'nombre' => 'D.S.C. Nº6 - Termas de Rio Hondo', 'codigo' => '6', 'created_at' => '2025-06-25 08:23:11', 'updated_at' => '2025-06-25 08:23:11'],
            ['id' => 10, 'nombre' => 'D.S.C. Nº7 - Frias', 'codigo' => '7', 'created_at' => '2025-06-25 08:23:36', 'updated_at' => '2025-06-25 08:23:36'],
            ['id' => 11, 'nombre' => 'D.S.C. Nº8 - Fernández', 'codigo' => '8', 'created_at' => '2025-06-25 08:24:14', 'updated_at' => '2025-06-25 08:24:14'],
            ['id' => 12, 'nombre' => 'D.S.C. Nº9 - Loreto', 'codigo' => '9', 'created_at' => '2025-06-25 08:24:31', 'updated_at' => '2025-06-25 17:16:34'],
            ['id' => 13, 'nombre' => 'D.S.C. Nº10 - Nueva Esperanza', 'codigo' => '10', 'created_at' => '2025-06-25 08:26:34', 'updated_at' => '2025-06-25 08:26:34'],
            ['id' => 14, 'nombre' => 'D.S.C. Nº11 - Monte Quemado', 'codigo' => '11', 'created_at' => '2025-06-25 08:26:53', 'updated_at' => '2025-06-25 08:26:53'],
            ['id' => 15, 'nombre' => 'D.S.C. Nº12 - Quimilí', 'codigo' => '12', 'created_at' => '2025-06-25 08:27:26', 'updated_at' => '2025-06-25 08:27:26'],
            ['id' => 16, 'nombre' => 'D.S.C. Nº13 - Añatuya', 'codigo' => '13', 'created_at' => '2025-06-25 08:27:43', 'updated_at' => '2025-06-25 08:27:43'],
            ['id' => 17, 'nombre' => 'D.S.C. Nº14 - Pinto', 'codigo' => '14', 'created_at' => '2025-06-25 08:27:57', 'updated_at' => '2025-06-25 08:27:57'],
            ['id' => 18, 'nombre' => 'D.S.C. Nº15 - Ojo de Agua', 'codigo' => '15', 'created_at' => '2025-06-25 08:28:10', 'updated_at' => '2025-06-25 08:28:10'],
            ['id' => 19, 'nombre' => 'D.S.C. Nº16 - Los Flores', 'codigo' => '16', 'created_at' => '2025-06-25 08:28:22', 'updated_at' => '2025-06-25 08:28:22'],
            ['id' => 20, 'nombre' => 'D.S.C. Nº17 - Belén', 'codigo' => '17', 'created_at' => '2025-06-25 08:28:47', 'updated_at' => '2025-06-25 08:28:47'],
            ['id' => 21, 'nombre' => 'D.S.C. Nº18 - Herrera', 'codigo' => '18', 'created_at' => '2025-06-25 08:29:08', 'updated_at' => '2025-06-25 08:29:08'],
            ['id' => 22, 'nombre' => 'D.S.C. Nº19 - Villa del Carmen', 'codigo' => '19', 'created_at' => '2025-06-25 08:29:20', 'updated_at' => '2025-06-25 17:16:46']
        ]);
    }
}
