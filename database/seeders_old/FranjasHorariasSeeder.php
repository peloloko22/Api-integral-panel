<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FranjasHorariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('franja_horarias')->insert([
            [
                'id' => 1,
                'hora_inicio' => '00:00:00',
                'hora_fin' => '05:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'hora_inicio' => '06:00:00',
                'hora_fin' => '11:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'hora_inicio' => '12:00:00',
                'hora_fin' => '17:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'hora_inicio' => '18:00:00',
                'hora_fin' => '23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
