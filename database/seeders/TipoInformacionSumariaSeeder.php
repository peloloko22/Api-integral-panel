<?php

namespace Database\Seeders;

use App\Models\TipoInformacionSumaria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInformacionSumariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoInformacionSumaria::create([
            'nombre' => 'Muerte dudosa',
        ]);
        TipoInformacionSumaria::create([
            'nombre' => 'Ahogamiento',
        ]);
        TipoInformacionSumaria::create([
            'nombre' => 'Paradero y ubicación - NIÑOS',
        ]);
        TipoInformacionSumaria::create([
            'nombre' => 'Paradero y ubicación - ADULTOS',
        ]);
    }
}
