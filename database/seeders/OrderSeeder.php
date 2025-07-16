<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Client;
use App\Models\Dish;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $dishes = Dish::all();

        if ($clients->isEmpty() || $dishes->isEmpty()) {
            $this->command->warn('تأكد من وجود بيانات في clients و dishes قبل تشغيل OrderSeeder.');
            return;
        }

        // إنشاء 20 طلب مرتبط بعميل وأكلة
        for ($i = 0; $i < 20; $i++) {
            Order::factory()->create([
                'client_id' => $clients->random()->id,
                'dish_id' => $dishes->random()->id,
            ]);
        }

        $this->command->info('تم إنشاء 20 طلب بنجاح.');
    }
}



