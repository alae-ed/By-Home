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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // 🔗 العميل لي دار التقييم
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');

            // 🔗 الأكلة لي تقييمات
            $table->foreignId('dish_id')->constrained()->onDelete('cascade');

            $table->tinyInteger('rating')->unsigned(); // مثلا من 1 حتى 5
            $table->text('comment')->nullable();       // تعليق اختياري

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

