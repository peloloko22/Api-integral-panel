<?php

namespace Database\Seeders;

use App\Models\TipoSuicidio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSuicidioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoSuicidio::create([
            'nombre' => 'Consumado',
            'codigo_sat' => '1',
        ]);
        TipoSuicidio::create([
            'nombre' => 'Tentativa',
            'codigo_sat' => '2',
        ]);
        TipoSuicidio::create([
            'nombre' => 'Sin determinar',
            'codigo_sat' => '99',
        ]);
    }
}
