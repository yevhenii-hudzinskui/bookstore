<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country' => fake()->country(),
        ];
    }

    public function franko(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Ivan Franko',
                'country' => 'ukraine',
            ];
        });
    }

    public function ukraine(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => 'ukraine',
            ];
        });
    }

    public function usa(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => 'usa',
            ];
        });
    }
}
