<?php

namespace Database\Seeders;

use App\Models\Ajetreo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AjetreoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nombre' => '1-ENTIBIO'
            ],[
                'nombre' => 'A-GESTION'
            ],[
                'nombre' => 'B-LLAMADA DE CERO'
            ],[
                'nombre' => 'C-INTENTANDO CONTACTAR'
            ]
        ];
        foreach ($items as $item) {
            Ajetreo::create($item);
        }
    }
}
