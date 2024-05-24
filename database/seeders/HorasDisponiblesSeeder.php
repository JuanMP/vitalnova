<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorasDisponiblesSeeder extends Seeder
{
    public function run()
    {
        // Insertar horas disponibles en la mañana
        $horas_manana = [
            '09:00:00',
            '10:00:00',
            '11:00:00',
        ];
        foreach ($horas_manana as $hora) {
            DB::table('horas_disponibles')->insert(['hora' => $hora]);
        }

        // Insertar horas disponibles en la tarde
        $horas_tarde = [
            '14:00:00',
            '15:00:00',
            '16:00:00',
        ];
        foreach ($horas_tarde as $hora) {
            DB::table('horas_disponibles')->insert(['hora' => $hora]);
        }
    }
}
