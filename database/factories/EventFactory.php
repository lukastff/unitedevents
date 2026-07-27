<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'city' => fake()->city(),
            'private' => false,
            'date' => fake()->dateTimeBetween('now', '+1 year'),
            'items' => [],
            'image' => 'default.jpg',
            'user_id' => User::factory(),
        ];
    }
}
