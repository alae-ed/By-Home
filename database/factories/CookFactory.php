<?php

namespace Database\Factories;

use App\Models\Cook;
use App\Models\User;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CookFactory extends Factory
{
    protected $model = Cook::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'full_name' => $this->faker->name(),
            'country' => 'المغرب',
            'city_id' => City::inRandomOrder()->value('id') ?? City::factory(),
            'email' => $this->faker->unique()->safeEmail(),
            'food_types' => $this->faker->randomElements([
                'الكسكس', 'الطاجين', 'البسطيلة', 'الحريرة', 'الشباكية', 'الرفيسة', 'الدجاج المحمر'
            ], rand(2, 4)),
            'sample_image' => 'cooks/sample_' . rand(1, 5) . '.jpg',
        ];
    }
}


