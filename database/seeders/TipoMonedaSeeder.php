<?php

namespace Database\Seeders;

use App\Models\TipoMoneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoMoneda::create([
            'nombre' => 'Peso Argentino',
        ]);
        TipoMoneda::create([
            'nombre' => 'Dólar',
        ]);
        TipoMoneda::create([
            'nombre' => 'SIN DETERMINAR',
        ]);
    }
}
