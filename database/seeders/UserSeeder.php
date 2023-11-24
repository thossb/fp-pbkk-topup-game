<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create(); // Creates 10 users using the factory.

        DB::table('user')->insert([
            'name' => 'Timothy',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
