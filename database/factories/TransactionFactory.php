<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $paymentProofPath = 'payment-proof/' . Str::random(20) . '.png'; // Generate a random filename with a .png extension.

        return [
            'description' => $this->faker->randomElement(['mantab gan', 'ditunggu', 'mantab diskon']),
            'payment_method' => $this->faker->randomElement(['bank bca', 'bank mandiri', 'gopay', 'ovo']),
            'payment_proof' => $paymentProofPath,
            'transaction_date' => $this->faker->dateTime,
            'user_id' => User::inRandomOrder()->first()->id,
            'game_id' => Game::inRandomOrder()->first()->id,
        ];
    }
}

