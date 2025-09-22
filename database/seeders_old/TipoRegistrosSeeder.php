<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoRegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_registros')->insert([
            [
                'id' => 1,
                'nombre' => 'Denuncia',
                'codigo_sat' => 'SAT001',
                'codigo_snic' => 'SNIC001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'Acta',
                'codigo_sat' => 'SAT002',
                'codigo_snic' => 'SNIC002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Informe',
                'codigo_sat' => 'SAT003',
                'codigo_snic' => 'SNIC003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Sumario',
                'codigo_sat' => 'SAT004',
                'codigo_snic' => 'SNIC004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
