<?php

namespace Database\Seeders;

use App\Models\EstadoElemento;
use Illuminate\Database\Seeder;

class EstadoElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoElemento::create([
            'nombre' => 'SUSTRAIDO',
        ]);
        EstadoElemento::create([
            'nombre' => 'DAÑADO',
        ]);
        EstadoElemento::create([
            'nombre' => 'SECUESTRADO',
        ]);
    }
}
