<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'price' => fake()->numberBetween(20,200),
            'stock' => fake()->numberBetween(15, 50),
            'reserved_count' => fake()->numberBetween(2, 8),

        ];
    }
}
