<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DenunciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $tiposDenuncia = DB::table('tipo_denuncias')->pluck('id')->toArray();
        $dependencias = DB::table('dependencias')->pluck('id')->toArray();
        $usuarios = DB::table('users')->pluck('id')->toArray();
        
        if (empty($tiposDenuncia)) {
            $this->command->warn('No hay tipos de denuncia disponibles. Ejecute TipoDenunciasSeeder primero.');
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

        DB::table('denuncias')->insert([
            [
                'id' => 1,
                'tipo_denuncia_id' => $tiposDenuncia[0], // Robo
                'dependencia_id' => $dependencias[0],
                'fecha' => now()->subDays(5),
                'user_id' => $usuarios[0], // Administrador
                'latitud' => -27.4512,
                'longitud' => -58.9866,
                'relato' => 'Se reporta robo en vía pública en la zona del centro. El denunciante manifiesta que fue abordado por dos personas que le sustrajeron su teléfono celular y billetera.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'tipo_denuncia_id' => $tiposDenuncia[1], // Hurto
                'dependencia_id' => $dependencias[0],
                'fecha' => now()->subDays(3),
                'user_id' => $usuarios[1], // Visor
                'latitud' => -27.4520,
                'longitud' => -58.9870,
                'relato' => 'Hurto de mochila en comercio del barrio norte. La víctima dejó su mochila en una silla y al regresar ya no estaba.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'tipo_denuncia_id' => $tiposDenuncia[2], // Daños
                'dependencia_id' => $dependencias[0],
                'fecha' => now()->subDays(1),
                'user_id' => $usuarios[2], // María
                'latitud' => -27.4530,
                'longitud' => -58.9880,
                'relato' => 'Daños en vehículo estacionado. Se encontró el auto con la puerta del conductor abollada y la ventanilla rota.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
