<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Cook;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        $cooks = Cook::all();

        if ($cooks->isEmpty()) {
            $this->command->warn('لا يوجد أي طباخ في قاعدة البيانات. تأكد من تشغيل CookSeeder أولاً.');
            return;
        }

        $cooks->each(function ($cook) {
            Dish::factory(3)->create([
                'cook_id' => $cook->id,
            ]);
        });

        $this->command->info('تم إنشاء الأطباق بنجاح لكل طباخ.');
    }
}



