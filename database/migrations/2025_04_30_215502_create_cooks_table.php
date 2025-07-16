<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // العلاقة مع users
            $table->string('full_name');
            $table->string('country');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->string('email')->unique();
            $table->json('food_types'); // أنواع الأكل كـ JSON
            $table->string('sample_image')->nullable(); // صورة نموذجية
            $table->timestamps();
        });
    }
};
