<?php

namespace Database\Factories;

use App\Models\GameDenom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class GameDenomFactory extends Factory
{
    public function definition()
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
            'price' => $this->faker->numberBetween(10000, 1000000),
            'denom' => Arr::random($denomExamples),
            'game_id' => Arr::random($gameIdExamples),
        ];
    }
}
