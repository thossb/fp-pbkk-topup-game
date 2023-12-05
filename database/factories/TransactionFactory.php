<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Game;
use App\Models\GameDenom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $paymentProofPath = 'payment-proof/' . Str::random(20) . '.png';

        $user = User::inRandomOrder()->first();
        $game = Game::inRandomOrder()->first();
        $gameDenom = GameDenom::inRandomOrder()->first();

        return [
            'username' => $this->faker->userName,
            'server' => $this->faker->word,
            'phone_number' => $this->faker->phoneNumber,
            'payment_method' => $this->faker->randomElement(['qris', 'gopay', 'dana', 'shopee', 'va']),
            'payment_proof' => $paymentProofPath,
            'status' => $this->faker->randomElement(['pending', 'succeed', 'failed']),
            'denom_id' => $gameDenom->id ?? GameDenom::factory()->create()->id,
            'game_id' => $game->id ?? Game::factory()->create()->id,
            'user_id' => $user->id ?? User::factory()->create()->id,
        ];
    }
}
