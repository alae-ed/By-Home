<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        // مدن مغربية شائعة
        $cities = [
            'الدار البيضاء',
            'الرباط',
            'مراكش',
            'فاس',
            'أكادير',
            'طنجة',
            'وجدة',
            'تطوان',
            'الجديدة',
            'بني ملال'
        ];

        foreach ($cities as $cityName) {
            City::create(['name' => $cityName]);
        }

        // أو إنشاء مدن وهمية إضافية
        // City::factory(5)->create();
    }
}

