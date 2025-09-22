<?php

namespace Database\Seeders;

use App\Models\ConsecuenciaHecho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsecuenciaSeeder extends Seeder
{

    public function run(): void
    {
        ConsecuenciaHecho::create([
            'nombre' => 'ILESO',
        ]);
        ConsecuenciaHecho::create([
            'nombre' => 'HERIDO LEVE',
        ]);
        ConsecuenciaHecho::create([
            'nombre' => 'HERIDO GRAVE',
        ]);
        ConsecuenciaHecho::create([
            'nombre' => 'FALLECIDO',
        ]);
        ConsecuenciaHecho::create([
            'nombre' => 'OTRO',
        ]);
        ConsecuenciaHecho::create([
            'nombre' => 'SIN DETERMINAR',
        ]);
    }
}
