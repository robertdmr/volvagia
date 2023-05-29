<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //llamar al seeder situacion
        $this->call(SituacionSeeder::class);
        $this->call(AjetreoSeeder::class);
        $this->call(AsesorSeeder::class);

        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

    }
}
