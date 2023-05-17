<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(rand(1, 5), true)),
            'release_year' => $this->faker->year(),
            'duration_minutes' => $this->faker->numberBetween(60, 180),
            'plot_summary' => $this->faker->paragraph(),
            'user_id' => $this->faker->numberBetween(1, 1)
        ];
    }
}
