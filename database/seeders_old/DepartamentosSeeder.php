<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            ['id' => 1, 'nombre' => 'Aguirre', 'codigo' => '7', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:38:29', 'updated_at' => '2025-06-26 08:38:29'],
            ['id' => 2, 'nombre' => 'Alberdi', 'codigo' => '14', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:38:47', 'updated_at' => '2025-06-26 08:38:47'],
            ['id' => 3, 'nombre' => 'Atamisqui', 'codigo' => '21', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:39:04', 'updated_at' => '2025-06-26 08:39:04'],
            ['id' => 5, 'nombre' => 'Avellaneda', 'codigo' => '28', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:46:01', 'updated_at' => '2025-06-26 08:46:01'],
            ['id' => 6, 'nombre' => 'Banda', 'codigo' => '35', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:46:35', 'updated_at' => '2025-06-26 08:46:35'],
            ['id' => 7, 'nombre' => 'Capital', 'codigo' => '49', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:47:46', 'updated_at' => '2025-06-26 08:47:46'],
            ['id' => 8, 'nombre' => 'Loreto', 'codigo' => '105', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:48:13', 'updated_at' => '2025-06-26 08:48:13'],
            ['id' => 10, 'nombre' => 'Choya', 'codigo' => '63', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:54:20', 'updated_at' => '2025-06-26 08:54:20'],
            ['id' => 11, 'nombre' => 'Copo', 'codigo' => '56', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:54:49', 'updated_at' => '2025-06-26 08:54:49'],
            ['id' => 12, 'nombre' => 'Figueroa', 'codigo' => '70', 'provincia_id' => 1, 'created_at' => '2025-06-26 08:59:00', 'updated_at' => '2025-06-26 08:59:00'],
            ['id' => 13, 'nombre' => 'General Taboada', 'codigo' => '77', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:03:55', 'updated_at' => '2025-06-26 09:03:55'],
            ['id' => 14, 'nombre' => 'Guasayan', 'codigo' => '84', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:04:11', 'updated_at' => '2025-06-26 09:04:11'],
            ['id' => 15, 'nombre' => 'Jimenez', 'codigo' => '91', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:06:09', 'updated_at' => '2025-06-26 09:06:09'],
            ['id' => 16, 'nombre' => 'Juan Felipe Ibarra', 'codigo' => '98', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:06:34', 'updated_at' => '2025-06-26 09:06:34'],
            ['id' => 18, 'nombre' => 'Moreno', 'codigo' => '119', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:17:56', 'updated_at' => '2025-06-26 09:17:56'],
            ['id' => 19, 'nombre' => 'Mitre', 'codigo' => '112', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:18:19', 'updated_at' => '2025-06-26 09:18:19'],
            ['id' => 20, 'nombre' => 'Ojo De Agua', 'codigo' => '126', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:18:42', 'updated_at' => '2025-06-26 09:18:42'],
            ['id' => 21, 'nombre' => 'Pellegrini', 'codigo' => '133', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:20:16', 'updated_at' => '2025-06-26 09:20:16'],
            ['id' => 22, 'nombre' => 'Quebrachos', 'codigo' => '140', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:20:35', 'updated_at' => '2025-06-26 09:20:35'],
            ['id' => 23, 'nombre' => 'Rio Hondo', 'codigo' => '147', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:20:49', 'updated_at' => '2025-06-26 09:20:49'],
            ['id' => 24, 'nombre' => 'Rivadavia', 'codigo' => '154', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:21:31', 'updated_at' => '2025-06-26 09:21:31'],
            ['id' => 25, 'nombre' => 'Robles', 'codigo' => '161', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:21:44', 'updated_at' => '2025-06-26 09:21:44'],
            ['id' => 26, 'nombre' => 'Salavina', 'codigo' => '168', 'provincia_id' => 1, 'created_at' => '2025-06-26 09:22:04', 'updated_at' => '2025-06-26 09:22:04'],
            ['id' => 28, 'nombre' => 'San Martin', 'codigo' => '175', 'provincia_id' => 1, 'created_at' => '2025-06-27 07:34:46', 'updated_at' => '2025-06-27 07:34:46'],
            ['id' => 29, 'nombre' => 'Sarmiento', 'codigo' => '185', 'provincia_id' => 1, 'created_at' => '2025-06-27 07:35:05', 'updated_at' => '2025-06-27 07:35:05'],
            ['id' => 30, 'nombre' => 'Silipica', 'codigo' => '198', 'provincia_id' => 1, 'created_at' => '2025-06-27 07:36:21', 'updated_at' => '2025-06-27 07:36:21'],
            ['id' => 31, 'nombre' => 'Belgrano', 'codigo' => '42', 'provincia_id' => 1, 'created_at' => '2025-06-27 07:52:10', 'updated_at' => '2025-06-27 07:52:10']
        ]);
    }
}
