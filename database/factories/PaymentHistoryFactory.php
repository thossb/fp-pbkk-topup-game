<?php

namespace Database\Factories;

use App\Models\PaymentHistory;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentHistoryFactory extends Factory
{
    protected $model = PaymentHistory::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();

        // Find transactions that the user has not already been associated with.
        $transaction = Transaction::where('user_id', $user->id)
            ->whereNotIn('id', PaymentHistory::where('user_id', $user->id)->pluck('transaction_id')->toArray())
            ->inRandomOrder()
            ->first();

        return $transaction
            ? [
                'payment_status' => $this->faker->randomElement(['lunas', 'on-kredit', 'paylater']),
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
            ]
            : [
                'payment_status' => 'lunas', // Provide a default value for payment_status.
            ];
    }
}

