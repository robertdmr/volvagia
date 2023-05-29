<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SituacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Situacion::create([
            'nombre' => 'PR'
        ],[
            'nombre' => 'SI'
        ],[
            'nombre' => 'VI'
        ],[
            'nombre' => 'NO'
        ]);
    }
}
