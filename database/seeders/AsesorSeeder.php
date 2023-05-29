<?php

namespace Database\Seeders;

use App\Models\Asesores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asesores::create([
            'nombre' => 'AM'
        ],[
            'nombre' => 'RA'
        ]);
    }
}
