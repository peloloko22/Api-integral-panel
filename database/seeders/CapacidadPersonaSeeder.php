<?php

namespace Database\Seeders;

use App\Models\CapacidadPersona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapacidadPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // normal
    // especial
    // insania mental
    // sin determinar
    public function run(): void
    {
        CapacidadPersona::create([
            'nombre' => 'normal',
        ]);
        CapacidadPersona::create([
            'nombre' => 'especial',
        ]);
        CapacidadPersona::create([
            'nombre' => 'insania mental',
        ]);
        CapacidadPersona::create([
            'nombre' => 'sin determinar',
        ]);
    }
}
