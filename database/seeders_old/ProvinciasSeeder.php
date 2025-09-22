<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provincias')->insert([
            [
                'id' => 1,
                'nombre' => 'Santiago Del Estero',
                'codigo' => '86',
                'created_at' => '2025-06-26 08:30:27',
                'updated_at' => '2025-06-26 08:30:27'
            ]
        ]);
    }
}
