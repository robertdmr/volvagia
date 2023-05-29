<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AjetreoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ajetreo::create([
            'nombre' => '1-ENTIBIO'
        ],[
            'nombre' => 'A-GESTION'
        ],[
            'nombre' => 'B-LLAMADA DE CERO'
        ],[
            'nombre' => 'C-INTENTANDO CONTACTAR'
        ]);
    }
}
