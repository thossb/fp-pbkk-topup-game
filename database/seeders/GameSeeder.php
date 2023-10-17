<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Game::factory(10)->create(); // Creates 10 games using the factory.
    }
}
