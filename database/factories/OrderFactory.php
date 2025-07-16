<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Client;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => fn () => Client::query()->inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'dish_id' => fn () => Dish::query()->inRandomOrder()->value('id') ?? Dish::factory()->create()->id,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'address' => $this->faker->address(),
        ];
    }
}


