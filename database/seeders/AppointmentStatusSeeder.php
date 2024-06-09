<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos a insertar en la tabla `appointment_status`
        $statuses = [
            ['id' => 1, 'status_name' => 'Pendiente'],
            ['id' => 2, 'status_name' => 'En curso'],
            ['id' => 3, 'status_name' => 'Finalizada Parcialmente'],
            ['id' => 4, 'status_name' => 'Cancelada'],
            ['id' => 5, 'status_name' => 'Finalizada Completa'],
        ];

        //Insertar los datos en la tabla `appointment_status`
        DB::table('appointment_status')->insert($statuses);
    }
}
