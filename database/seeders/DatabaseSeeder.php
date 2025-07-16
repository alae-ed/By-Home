<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // إنشاء مستخدم تجريبي
    \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    // مناداة seeder ديال cooks
    $this->call([
        UserSeeder::class,
        CitySeeder::class,
        ClientSeeder::class,
        CookSeeder::class,
        DishSeeder::class,
        OrderSeeder::class,
        
    ]);
}

}

