<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nombre' => 'Administrador',
                'apellido' => 'Tagliapietra',
                'email' => 'admin@example.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$y4KYeGDVgPwwhD8Em3jSb.GDul5Ex8Leb/9rEDN5s.g9DvT..rx8y',
                'telefono' => '3854000000',
                'dni' => '30000000',
                'domicilio' => 'Casa Central',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:37',
                'updated_at' => '2025-08-05 15:44:37',
                'sexo_id' => 1,
            ],
            [
                'id' => 2,
                'nombre' => 'Visor',
                'apellido' => 'Pérez',
                'email' => '1@1.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$74GGe.S06.OxOgzmiJllLe2wUtbNiG8s4/WTn0bx4hr9hobVZ9iMu',
                'telefono' => '3854000001',
                'dni' => '31000001',
                'domicilio' => 'Barrio Norte',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:37',
                'updated_at' => '2025-08-05 15:44:37',
                'sexo_id' => 1,
            ],
            [
                'id' => 3,
                'nombre' => 'María',
                'apellido' => 'Gómez',
                'email' => '2@2.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$Y3Gf5W.pYr3HKMSseQAJ7eEhq50rhpiDVARIaY08U.925YIurrhxq',
                'telefono' => '3854000002',
                'dni' => '32000002',
                'domicilio' => 'Barrio Sur',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:37',
                'updated_at' => '2025-08-05 15:44:37',
                'sexo_id' => 2,
            ],
            [
                'id' => 4,
                'nombre' => 'Carlos',
                'apellido' => 'López',
                'email' => '3@3.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$.RLdXW2dh0nGLEsz7gR86.eR9xt5/jGOdy6z.s0cIBumPnA/xpEyC',
                'telefono' => '3854000003',
                'dni' => '33000003',
                'domicilio' => 'Barrio Este',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:37',
                'updated_at' => '2025-08-05 15:44:37',
                'sexo_id' => 1,
            ],
            [
                'id' => 5,
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'email' => '4@4.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$M.k41X31x/2obvH4aN4jKumXMNI1JGTotbcw9OB4HhCSWis..hMY.',
                'telefono' => '3854000004',
                'dni' => '34000004',
                'domicilio' => 'Barrio Oeste',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:38',
                'updated_at' => '2025-08-05 15:44:38',
                'sexo_id' => 2,
            ],
            [
                'id' => 6,
                'nombre' => 'Cargador',
                'apellido' => 'Tag',
                'email' => '5@5.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$BnYsNCUjKF2983Xn.Wh1MuxemJhRgxyRVCdNRnebJvNNFSP47vVgm',
                'telefono' => '3854000005',
                'dni' => '35000005',
                'domicilio' => 'Centro',
                'remember_token' => NULL,
                'created_at' => '2025-08-05 15:44:38',
                'updated_at' => '2025-08-05 15:44:38',
                'sexo_id' => 2,
            ]
        ]);
    }
}
