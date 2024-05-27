<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialist;

class SpecialistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Seeder para asignar las clases de especialistas directamente
    public function run()
    {
        Specialist::create(['name' => 'Orthodontist']);
        Specialist::create(['name' => 'Dentist']);
        Specialist::create(['name' => 'Hygienist']);
    }
}
