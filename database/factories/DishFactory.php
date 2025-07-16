<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cook;


class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cook_id' => Cook::inRandomOrder()->value('id') ?? Cook::factory(),

            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(20, 100),
            'image' => 'dishes/default.jpg',
            'is_featured' => fake()->boolean(),
            'cuisine_type' => fake()->randomElement(['مغربي', 'شرقي', 'حلويات', 'مأكولات بحرية']),

        ];
    }
}
