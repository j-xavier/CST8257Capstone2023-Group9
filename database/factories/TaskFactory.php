<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tasklist_id' => fake()->numberBetween(1, 10),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(1),
            'priority_id' => fake()->numberBetween(1, 3),
            'start_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+1 week'),
        ];
    }
}
