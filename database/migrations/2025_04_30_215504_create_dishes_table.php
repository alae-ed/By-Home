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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();

            // 🔗 الطباخ لي كيعرض الأكلة
            $table->foreignId('cook_id')->constrained('users')->onDelete('cascade');

            $table->string('name');             // اسم الأكلة
            $table->text('description');        // وصف مفصل
            $table->decimal('price', 8, 2);     // الثمن
            $table->string('image')->nullable(); // مسار الصورة
            $table->string('cuisine_type');     // نوع الطبخ: مغربي، شرقي، إلخ

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};

