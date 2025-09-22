<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NovedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $tiposNovedad = DB::table('tipo_novedades')->pluck('id')->toArray();
        $dependencias = DB::table('dependencias')->pluck('id')->toArray();
        $usuarios = DB::table('users')->pluck('id')->toArray();
        $fiscales = DB::table('fiscales')->pluck('id')->toArray();
        $barrios = DB::table('barrios')->pluck('id')->toArray();
        
        if (empty($tiposNovedad)) {
            $this->command->warn('No hay tipos de novedad disponibles. Ejecute TipoNovedadesSeeder primero.');
            return;
        }

        if (empty($dependencias)) {
            $this->command->warn('No hay dependencias disponibles. Ejecute DependenciasSeeder primero.');
            return;
        }

        if (empty($usuarios)) {
            $this->command->warn('No hay usuarios disponibles. Ejecute UsersSeeder primero.');
            return;
        }

        if (empty($fiscales)) {
            $this->command->warn('No hay fiscales disponibles. Ejecute FiscalesSeeder primero.');
            return;
        }

        if (empty($barrios)) {
            $this->command->warn('No hay barrios disponibles. Ejecute BarriosSeeder primero.');
            return;
        }

        DB::table('novedades')->insert([
            [
                'id' => 1,
                'detalle_sintesis' => 'Robo en vía pública',
                'hora_hecho' => '14:30:00',
                'calle_ruta' => 'Av. San Martín',
                'altura_km' => '500',
                'mas_detalles_direccion' => 'Frente al supermercado',
                'fiscal_id' => $fiscales[0],
                'tipo_novedad_id' => $tiposNovedad[0],
                'barrio_id' => $barrios[0],
                'dependencia_id' => $dependencias[0],
                'user_id' => $usuarios[0],
                'latitud' => -27.4512,
                'longitud' => -58.9866,
                'incluir_parte' => 1,
                'revisada' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'detalle_sintesis' => 'Accidente de tránsito',
                'hora_hecho' => '16:45:00',
                'calle_ruta' => 'Ruta Nacional 16',
                'altura_km' => '25',
                'mas_detalles_direccion' => 'Km 25, curva peligrosa',
                'fiscal_id' => $fiscales[1],
                'tipo_novedad_id' => $tiposNovedad[1],
                'barrio_id' => $barrios[1],
                'dependencia_id' => $dependencias[0],
                'user_id' => $usuarios[1],
                'latitud' => -27.4520,
                'longitud' => -58.9870,
                'incluir_parte' => 1,
                'revisada' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
