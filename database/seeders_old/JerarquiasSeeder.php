<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JerarquiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('jerarquias')->insert([
            [
                'id' => 1,
                'nombre' => 'AGENTE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'CABO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'CABO 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'SARGENTO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'SARGENTO 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nombre' => 'SARGENTEO AYUDANTE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nombre' => 'SUBOFICIAL PRINCIPAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nombre' => 'SUBOFICIAL MAYOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nombre' => 'OF. AYUDANTE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'nombre' => 'OF. SUBINSP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'nombre' => 'OF. INSP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'nombre' => 'OF. PPAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'nombre' => 'SUBCOMISARIO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'nombre' => 'COMISARIO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'nombre' => 'COMISARIO INSPECTOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'nombre' => 'COMISARIO MAYOR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'nombre' => 'COMISARIO GENERAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
