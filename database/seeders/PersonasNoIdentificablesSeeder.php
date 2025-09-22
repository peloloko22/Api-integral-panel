<?php

namespace Database\Seeders;

use App\Models\Personas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonasNoIdentificablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     // masculino 
     // femenino
     // masculino menor de edad
     // femenino menor de edad
     // masculino mayor de edad
     // femenino mayor de edad
    public function run(): void
    {
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Mas',
        ]);
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Femenino',
        ]);
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Masculino menor de edad',
        ]);

        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Femenino menor de edad',
        ]);
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Masculino mayor de edad',
        ]);
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Femenino mayor de edad',
        ]);
        Personas::create([
            'no_identificable' => true,
            'no_identificable_nombre' => 'Sin determinar',
        ]);
    }
}
