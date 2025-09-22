<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos existentes
        $tiposPersona = DB::table('tipo_personas')->pluck('id')->toArray();
        $generos = DB::table('generos')->pluck('id')->toArray();
        $nacionalidades = DB::table('nacionalidades')->pluck('id')->toArray();
        $sexos = DB::table('sexos')->pluck('id')->toArray();
        $condicionesPersona = DB::table('condicion_personas')->pluck('id')->toArray();
        $ocupaciones = DB::table('ocupaciones')->pluck('id')->toArray();
        $nivelesInstruccion = DB::table('nivel_instrucciones')->pluck('id')->toArray();
        
        if (empty($tiposPersona)) {
            $this->command->warn('No hay tipos de persona disponibles. Ejecute TipoPersonasSeeder primero.');
            return;
        }

        if (empty($generos)) {
            $this->command->warn('No hay géneros disponibles. Ejecute GenerosSeeder primero.');
            return;
        }

        if (empty($nacionalidades)) {
            $this->command->warn('No hay nacionalidades disponibles. Ejecute NacionalidadesSeeder primero.');
            return;
        }

        if (empty($sexos)) {
            $this->command->warn('No hay sexos disponibles. Ejecute SexosSeeder primero.');
            return;
        }

        if (empty($condicionesPersona)) {
            $this->command->warn('No hay condiciones de persona disponibles. Ejecute CondicionPersonasSeeder primero.');
            return;
        }

        if (empty($ocupaciones)) {
            $this->command->warn('No hay ocupaciones disponibles. Ejecute OcupacionesSeeder primero.');
            return;
        }

        if (empty($nivelesInstruccion)) {
            $this->command->warn('No hay niveles de instrucción disponibles. Ejecute NivelInstruccionSeeder primero.');
            return;
        }

        DB::table('personas')->insert([
            [
                'id' => 1,
                'nombre' => 'Juan Carlos',
                'apellido' => 'González',
                'dni' => '35000001',
                'telefono' => '3854002001',
                'tipo_persona_id' => $tiposPersona[0], // Primera opción
                'genero_id' => $generos[0], // Primera opción
                'nacionalidad_id' => $nacionalidades[0], // Primera opción
                'sexo_id' => $sexos[0], // Primera opción
                'condicion_persona_id' => $condicionesPersona[0], // Primera opción
                'ocupacion_id' => $ocupaciones[0], // Primera opción
                'nivel_instruccion_id' => $nivelesInstruccion[0], // Primera opción
                'fecha_nacimiento' => '1985-03-15',
                'domicilio' => 'Av. San Martín 123',
                'clase' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'María Elena',
                'apellido' => 'Rodríguez',
                'dni' => '35000002',
                'telefono' => '3854002002',
                'tipo_persona_id' => $tiposPersona[0], // Primera opción
                'genero_id' => $generos[1], // Segunda opción
                'nacionalidad_id' => $nacionalidades[0], // Primera opción
                'sexo_id' => $sexos[1], // Segunda opción
                'condicion_persona_id' => $condicionesPersona[0], // Primera opción
                'ocupacion_id' => $ocupaciones[1], // Segunda opción
                'nivel_instruccion_id' => $nivelesInstruccion[1], // Segunda opción
                'fecha_nacimiento' => '1990-07-22',
                'domicilio' => 'Calle Norte 456',
                'clase' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Carlos Alberto',
                'apellido' => 'López',
                'dni' => '35000003',
                'telefono' => '3854002003',
                'tipo_persona_id' => $tiposPersona[0], // Primera opción
                'genero_id' => $generos[0], // Primera opción
                'nacionalidad_id' => $nacionalidades[0], // Primera opción
                'sexo_id' => $sexos[0], // Primera opción
                'condicion_persona_id' => $condicionesPersona[0], // Primera opción
                'ocupacion_id' => $ocupaciones[2], // Tercera opción
                'nivel_instruccion_id' => $nivelesInstruccion[2], // Tercera opción
                'fecha_nacimiento' => '1988-11-08',
                'domicilio' => 'Ruta 16 Km 25',
                'clase' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nombre' => 'Ana Sofía',
                'apellido' => 'Martínez',
                'dni' => '35000004',
                'telefono' => '3854002004',
                'tipo_persona_id' => $tiposPersona[0], // Primera opción
                'genero_id' => $generos[1], // Segunda opción
                'nacionalidad_id' => $nacionalidades[0], // Primera opción
                'sexo_id' => $sexos[1], // Segunda opción
                'condicion_persona_id' => $condicionesPersona[0], // Primera opción
                'ocupacion_id' => $ocupaciones[3], // Cuarta opción
                'nivel_instruccion_id' => $nivelesInstruccion[3], // Cuarta opción
                'fecha_nacimiento' => '1992-05-12',
                'domicilio' => 'Barrio Sur 789',
                'clase' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nombre' => 'Roberto Daniel',
                'apellido' => 'Fernández',
                'dni' => '35000005',
                'telefono' => '3854002005',
                'tipo_persona_id' => $tiposPersona[0], // Primera opción
                'genero_id' => $generos[0], // Primera opción
                'nacionalidad_id' => $nacionalidades[0], // Primera opción
                'sexo_id' => $sexos[0], // Primera opción
                'condicion_persona_id' => $condicionesPersona[0], // Primera opción
                'ocupacion_id' => $ocupaciones[4], // Quinta opción
                'nivel_instruccion_id' => $nivelesInstruccion[4], // Quinta opción
                'fecha_nacimiento' => '1983-09-30',
                'domicilio' => 'Centro Comercial 321',
                'clase' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
