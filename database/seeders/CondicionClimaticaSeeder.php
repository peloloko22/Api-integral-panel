<?php

namespace Database\Seeders;

use App\Models\CondicionClimatica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CondicionClimaticaSeeder extends Seeder
{
    
    public function run(): void
    {
        CondicionClimatica::create([
            'nombre' => 'BUENO',
            'codigo' => '1',
        ]);
        CondicionClimatica::create([
            'nombre' => 'NUBLADO',
            'codigo' => '2',
        ]);
        CondicionClimatica::create([
            'nombre' => 'LLUVIA',
            'codigo' => '3',
        ]);
        CondicionClimatica::create([
            'nombre' => 'LLOVIZNA',
            'codigo' => '4',
        ]);
        CondicionClimatica::create([
            'nombre' => 'NIEVE',
            'codigo' => '5',
        ]);
        CondicionClimatica::create([
            'nombre' => 'GRANIZO',
            'codigo' => '6',
        ]);
        CondicionClimatica::create([
            'nombre' => 'OTRA CONDICION',
            'codigo' => '7',
        ]);
        CondicionClimatica::create([
            'nombre' => 'SIN DETERMINAR',
            'codigo' => '99',
        ]);
    }
}
