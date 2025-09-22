<?php

namespace Database\Seeders;

use App\Models\MecanismoSuicidio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MecanismoSuicidioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MecanismoSuicidio::create([
            'nombre' => 'Arma de fuego',
            'codigo' => '1',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Arma blanca / elemento cortante',
            'codigo' => '2',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Sumersion en piscina / mar / rio',
            'codigo' => '3',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Envenenamiento',
            'codigo' => '4',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Ahorcamiento',
            'codigo' => '5',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Se arroja al vacio',
            'codigo' => '6',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Se arroja a las vias del ff. cc.',
            'codigo' => '7',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Otra modalidad (especificar)',
            'codigo' => '8',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Se incinera',
            'codigo' => '9',
        ]);
        MecanismoSuicidio::create([
            'nombre' => 'Sin determinar',
            'codigo' => '99',
        ]);
    }
}
