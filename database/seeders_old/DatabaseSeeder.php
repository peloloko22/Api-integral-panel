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
            // Datos básicos de personas
            SexosSeeder::class,
            GenerosSeeder::class,
            NacionalidadesSeeder::class,
            TipoPersonaSeeder::class,
            CondicionPersonaSeeder::class,
            NivelInstruccionSeeder::class,
            OcupacionSeeder::class,
            RolPersonaSeeder::class,
            
            // Datos geográficos (en orden de dependencia)
            ProvinciasSeeder::class,
            DepartamentosSeeder::class,
            DepartamentalesSeeder::class,
            DependenciasSeeder::class,
            MunicipiosSeeder::class,
            LocalidadesSeeder::class,
            BarriosSeeder::class,
            
            // Datos de usuarios y roles
            RolesSeeder::class,
            PermisosSeeder::class,
            PermisosRolesSeeder::class,
            UsersSeeder::class,
            RolUsuariosSeeder::class,
            
            // Datos de funcionarios y jerarquías
            JerarquiasSeeder::class,
            FuncionariosSeeder::class,
            FiscalesSeeder::class,
            
            // Datos de tipos y categorías básicas
            TipoAlertasSeeder::class,
            TipoNovedadesSeeder::class,
            TipoDenunciasSeeder::class,
            TipoRegistrosSeeder::class,
            TipoLugaresSeeder::class,
            TipoViasSeeder::class,
            TipoZonasSeeder::class,
            FranjasHorariasSeeder::class,
            
            // Datos de elementos
            EstadoElementoSeeder::class,
            CategoriaElementoSeeder::class,
            
            // Datos de siniestros viales
            TipoSiniestrosSeeder::class,
            SemaforoSiniestrosSeeder::class,
            CondicionesClimaticasSeeder::class,
            TipoVehiculosSeeder::class,
            
            // Datos de suicidios
            MecanismosSuicidioSeeder::class,
            TipoLugarSuicidiosSeeder::class,
            
            // Datos de roles de siniestro
            RolesSiniestroSeeder::class,
            
            // Datos de delitos
            CategoriaDelitosSeeder::class,
            ModusOperandiSeeder::class,
            TipificacionDelitosSeeder::class,
            CalificacionesSeeder::class,
            ConfiguracionParteSeeder::class,
            
            // Datos de parajes
            ParajesSeeder::class,
            
            // Datos de grupos y relaciones
            GrupoPersonasSeeder::class,
            PersonaGrupoPersonasSeeder::class,
            TipoAlertaGrupoPersonasSeeder::class,
            AlertaJerarquiasSeeder::class,
            
            // Datos de personas
            PersonasSeeder::class,
            
            /* // Datos de denuncias y registros
            DenunciasSeeder::class, */
            
            // Datos de vehículos
            VehiculosSeeder::class,
            
            // Datos de novedades y alertas
            /* NovedadesSeeder::class,
            AlertasSeeder::class, */
        ]);
    }
}
