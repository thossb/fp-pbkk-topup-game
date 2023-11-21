<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameDenom>
 */
class GameDenomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $denomExamples = [
            '100',
            '200',
            '300',
            '400',
            '500',
        ];

        $gameIdExamples = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
        ];


        return [
            'price' => fake()->numberBetween(10000, 1000000),
            'denom' => Arr::random($denomExamples),
            'game_id' => Arr::random($gameIdExamples),
        ];
    }
}
