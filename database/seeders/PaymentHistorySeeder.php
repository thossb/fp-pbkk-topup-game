<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentHistorySeeder extends Seeder
{
    public function run()
    {
        \App\Models\PaymentHistory::factory(10)->create();
    }
}
