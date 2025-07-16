<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // 👥 تحديد نوع المستخدم (client أو cook)
            $table->enum('role', ['client', 'cook'])->default('client');

            // 📍معلومات إضافية للطباخين
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable(); // تعريف قصير للطباخ
            $table->json('food_types')->nullable(); // أنواع الطبخ لي كيجيدهم (json)

            // 🕓 Laravel timestamps
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

