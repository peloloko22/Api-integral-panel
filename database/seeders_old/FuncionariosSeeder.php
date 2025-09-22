<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios y jerarquías existentes
        $usuarios = DB::table('users')->pluck('id')->toArray();
        $jerarquias = DB::table('jerarquias')->pluck('id')->toArray();
        
        if (empty($usuarios)) {
            $this->command->warn('No hay usuarios disponibles. Ejecute UsersSeeder primero.');
            return;
        }

        if (empty($jerarquias)) {
            $this->command->warn('No hay jerarquías disponibles. Ejecute JerarquiasSeeder primero.');
            return;
        }

        DB::table('funcionarios')->insert([
            [
                'id' => 1,
                'lp' => 'LP001',
                'usuario_id' => $usuarios[0], // Administrador
                'jerarquia_id' => $jerarquias[0], // Comisario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'lp' => 'LP002',
                'usuario_id' => $usuarios[1], // Visor
                'jerarquia_id' => $jerarquias[2], // Oficial Principal
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'lp' => 'LP003',
                'usuario_id' => $usuarios[2], // María
                'jerarquia_id' => $jerarquias[3], // Oficial
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
