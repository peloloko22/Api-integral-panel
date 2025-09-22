<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModusOperandiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modusOperandis = [
            ['codigo_sat' => '101', 'codigo_snic' => '101', 'nombre' => 'Escalamiento'],
            ['codigo_sat' => '102', 'codigo_snic' => '102', 'nombre' => 'Rotura de puerta'],
            ['codigo_sat' => '103', 'codigo_snic' => '103', 'nombre' => 'Llave falsa'],
            ['codigo_sat' => '104', 'codigo_snic' => '104', 'nombre' => 'Perforación de pared'],
            ['codigo_sat' => '105', 'codigo_snic' => '105', 'nombre' => 'Intimidación con arma de fuego'],
            ['codigo_sat' => '106', 'codigo_snic' => '106', 'nombre' => 'Intimidación con arma blanca'],
            ['codigo_sat' => '107', 'codigo_snic' => '107', 'nombre' => 'Violencia física'],
            ['codigo_sat' => '108', 'codigo_snic' => '108', 'nombre' => 'Engaño o ardid'],
            ['codigo_sat' => '109', 'codigo_snic' => '109', 'nombre' => 'Descuido de la víctima'],
            ['codigo_sat' => '110', 'codigo_snic' => '110', 'nombre' => 'Inhibidor de alarma'],
            ['codigo_sat' => '111', 'codigo_snic' => '111', 'nombre' => 'Narcosis'],
            ['codigo_sat' => '112', 'codigo_snic' => '112', 'nombre' => 'Mechera/o'],
            ['codigo_sat' => '113', 'codigo_snic' => '113', 'nombre' => 'Arrebato'],
            ['codigo_sat' => '114', 'codigo_snic' => '114', 'nombre' => 'Rompevidrios'],
            ['codigo_sat' => '115', 'codigo_snic' => '115', 'nombre' => 'Inhibidor de señal'],
            ['codigo_sat' => '116', 'codigo_snic' => '116', 'nombre' => 'Secuestro virtual'],
            ['codigo_sat' => '117', 'codigo_snic' => '117', 'nombre' => 'Suplantación de identidad'],
            ['codigo_sat' => '118', 'codigo_snic' => '118', 'nombre' => 'Estafa telefónica'],
            ['codigo_sat' => '119', 'codigo_snic' => '119', 'nombre' => 'Abuso de confianza'],
            ['codigo_sat' => '120', 'codigo_snic' => '120', 'nombre' => 'Hackeo informático'],
        ];

        foreach ($modusOperandis as $modus) {
            DB::table('modus_operandis')->insert([
                'codigo_sat' => $modus['codigo_sat'],
                'codigo_snic' => $modus['codigo_snic'],
                'nombre' => $modus['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
