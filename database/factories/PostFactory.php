<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'review' => $this->faker->paragraph(),
            'rate' => $this->faker->randomFloat(1, 1, 10),
            'user_id' => $this->faker->numberBetween(1, 5),
            'movie_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
