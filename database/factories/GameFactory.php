<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Game::class;

    public function definition()
    {
        $nameExamples = [
            '500 diamond mobile legend',
            '1000 diamond mobile legend',
            '1000 robux',
            '500 robux',
        ];

        $descriptionExamples = [
            'sale diskon 10 persen',
            'sale diskon 20 persen',
            'sale diskon 5 persen',
            'sale diskon 15 persen',
        ];

        $price = $this->faker->numberBetween(10000, 250000); // Random price between 10,000 and 150,000.

        $categoryExamples = [
            'moba',
            'fps',
            'role-play',
        ];

        return [
            'name' => $this->faker->randomElement($nameExamples),
            'description' => $this->faker->randomElement($descriptionExamples),
            'price' => $price,
            'category' => $this->faker->randomElement($categoryExamples),
        ];
    }
}
