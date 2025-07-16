<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cook;
use App\Models\City;

class CookSeeder extends Seeder
{
    public function run(): void
    {
        $cooksData = [
            [
                'full_name' => 'فاطمة الزهراء',
                'country' => 'المغرب',
                'sample_image' => 'cooks/fatima.jpg',
                'email' => 'fatima@example.com',
                'food_types' => ['الكسكس', 'الطاجين', 'البسطيلة'],
            ],
            [
                'full_name' => 'أمينة',
                'country' => 'المغرب',
                'sample_image' => 'cooks/amina.jpg',
                'email' => 'amina@example.com',
                'food_types' => ['الحريرة', 'المشوي', 'البغرير'],
            ],
            // ...
        ];

        foreach ($cooksData as $cookData) {
            // إنشاء المستخدم المرتبط بالطباخة
            $user = User::factory()->create([
                'name' => $cookData['full_name'],
                'email' => $cookData['email'],
            ]);

            $city = City::inRandomOrder()->first();

            Cook::create([
                'user_id' => $user->id,
                'full_name' => $cookData['full_name'],
                'country' => $cookData['country'],
                'city_id' => $city?->id,
                'email' => $cookData['email'],
                'sample_image' => $cookData['sample_image'],
                'food_types' => $cookData['food_types'],
            ]);
        }
    }
}



