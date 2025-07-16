<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\City;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // تحقق واش كاين مدن في قاعدة البيانات
        if (City::count() === 0) {
            $this->command->warn('لا توجد مدن في قاعدة البيانات. تأكد من تشغيل CitySeeder أولاً.');
            return;
        }

        // إنشاء 10 عملاء عشوائيين
        Client::factory(10)->create();

        $this->command->info('تم إنشاء العملاء بنجاح.');
    }
}


