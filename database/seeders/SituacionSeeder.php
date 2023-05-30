<?php

namespace Database\Seeders;

use App\Models\Situacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SituacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nombre' => 'PR'
            ],
            [
                'nombre' => 'SI'
            ],
            [
                'nombre' => 'VI'
            ],
            [
                'nombre' => 'NO'
            ]
        ];
        foreach ($items as $item) {
            Situacion::create($item);
        }
    }
}
