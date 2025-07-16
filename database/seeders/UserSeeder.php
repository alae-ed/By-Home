<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء مستخدم وحيد ثابت (مثلاً أدمن أو طباخ)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // 👈 تأكد تبدلها في الإنتاج
        ]);

        // إنشاء مستخدمين عشوائيين آخرين
        User::factory(5)->create();
    }
}

