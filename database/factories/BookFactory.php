<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'author_id' => Author::factory()->create(),
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement(['Fiction', 'Non-Fiction', 'Science Fiction'])
        ];
    }
}
