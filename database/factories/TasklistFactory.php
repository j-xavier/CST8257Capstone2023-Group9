<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasklist>
 */
class TasklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 2),
            'title' => fake()->sentence(3),
            'color' => fake()->randomElement(['red', 'green', 'blue', 'yellow'])
        ];
    }
}
