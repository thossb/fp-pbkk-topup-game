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
            '600',
            '700',
            '800',
            '900',
            '1000'
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

        $randomDenom = Arr::random($denomExamples);
        
        return [
            'denom' => $randomDenom,
            'price' => (int)$randomDenom * 1000,
            'game_id' => Arr::random($gameIdExamples),
        ];
    }
}
