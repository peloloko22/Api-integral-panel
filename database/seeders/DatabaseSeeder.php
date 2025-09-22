<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*  User::factory()->create([
            'nombre' => 'Test nombre',
            "apellido" => 'Test Apellido',
            'email' => 'test@example.com',
        ]);
         */
        $this->call([

            TipoAlertasSeeder::class,
            TipoNovedadesSeeder::class,
            VehiculosSeeder::class,

            // datos geograficos
            ProvinciasSeeder::class,
            DepartamentosSeeder::class,
            LocalidadesSeeder::class,
            BarriosSeeder::class,
            TipoViaSeeder::class,
            TipoZonaSeeder::class,
            TipoLugarSeeder::class,


            // datos de dependencias
            DepartamentalesSeeder::class,
            DependenciasSeeder::class,


            // datos de registro
            TipoRegistroSeeder::class,

            // datos persona
            SexosSeeder::class,
            GenerosSeeder::class,
            NivelInstruccionSeeder::class,
            OcupacionesSeeder::class,
            CondicionPersonaSeeder::class,
            EstadoCivilSeeder::class,
            NacionalidadesSeeder::class,
            RolPersonaSeeder::class,
            TipoPersonaSeeder::class,
            CapacidadPersonaSeeder::class,

            // suicidios
            TipoSuicidioSeeder::class,
            MecanismoSuicidioSeeder::class,
            TipoLugarSuicidioSeeder::class,

            // Datos de usuarios y roles
            RolesSeeder::class,
            PermisosSeeder::class,
            PermisosRolesSeeder::class,
            UsersSeeder::class,
            RolUsuariosSeeder::class,

            // no identificables
            VehiculoNoIdentificableSeeder::class,
            PersonasNoIdentificablesSeeder::class,

            // elementos
            TipoMonedaSeeder::class,
            CategoriaElementoSeeder::class,
            EstadoElementoSeeder::class,

            // delitos
            ConsecuenciaSeeder::class,
            CalificacionDelitoSeeder::class,
            ModusOperandiSeeder::class,
            ConsecuenciaSeeder::class,
            TipoTransporteImputadoSeeder::class,
            VinculoVictimaSeeder::class,
            CategoriaDelitoSeeder::class,
            TipificacionDelitoSeeder::class,
            MecanismoArmaSeeder::class,

            //siniestros

            TipoVehiculoSeeder::class,
            TipoSiniestrosSeeder::class,
            RolesSiniestroSeeder::class,
            SemaforoSiniestrosSeeder::class,
            CondicionClimaticaSeeder::class,
            TipoLugarSiniestroVialSeeder::class,

            TipoEsclarecimientoSeeder::class,
            TipoInformacionSumariaSeeder::class,
            JerarquiasSeeder::class,
            
            // Procesamiento de denuncias desde JSON
            // DenunciasDinamicasSeeder::class, // Descomenta para procesar salida.json
        ]);
    }
}
