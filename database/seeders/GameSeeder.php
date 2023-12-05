<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class GameSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //\App\Models\Game::factory(10)->create(); // Creates 10 games using the factory.

        DB::table('games')->insert([
            'id' => '1',
            'name' => 'Mobile Legend',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'moba',
            'unit' => 'diamond',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '2',
            'name' => 'Roblox',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'role-play',
            'unit' => 'robux',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '3',
            'name' => 'Valorant',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'fps',
            'unit' => 'valorant points',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '4',
            'name' => 'PUBG Mobile',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'fps',
            'unit' => 'UC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '5',
            'name' => 'Free Fire',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'fps',
            'unit' => 'Diamonds',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '6',
            'name' => 'Fifa 24',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'soccer',
            'unit' => 'FCP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '7',
            'name' => 'COD Mobile',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'fps',
            'unit' => 'CP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '8',
            'name' => 'Genshin Impact',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'rpg',
            'unit' => 'Genesis Crystals',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '9',
            'name' => 'FC Mobile',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'soccer',
            'unit' => 'FC points',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('games')->insert([
            'id' => '10',
            'name' => 'Clash of Clans',
            'description' => Arr::random([
                'sale diskon 10 persen',
                'sale diskon 20 persen',
                'sale diskon 5 persen',
                'sale diskon 15 persen',
            ]),
            'category' => 'rpg',
            'unit' => 'Gems',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}





