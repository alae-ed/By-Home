<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'city_id' => City::count() ? City::inRandomOrder()->value('id') : City::factory(),
 // اختيار مدينة عشوائية إذا كانت موجودة
        ];
    }
}

