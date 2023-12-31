<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class GameFactory extends Factory
{
    public function definition()
    {
        $nameExamples = [
            'Mobile Legend',
            'Valorant',
            'Roblox',
            'League of Legends',
            'Ragnarok',
            'PUBG Mobile',
        ];

        $descriptionExamples = [
            'sale diskon 10 persen',
            'sale diskon 20 persen',
            'sale diskon 5 persen',
            'sale diskon 15 persen',
        ];

        $categoryExamples = [
            'moba',
            'fps',
            'role-play',
        ];

        $unitExamples = [
            'diamond',
            'robux',
            'coin',
            'point',
        ];

        return [
            'name' => Arr::random($nameExamples),
            'description' => Arr::random($descriptionExamples),
            'category' => Arr::random($categoryExamples),
            'unit' => Arr::random($unitExamples),
        ];
    }
}
