<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dishes', function (Blueprint $table) {
            // نحذف العمود القديم إن لم تعد تحتاجه
            if (Schema::hasColumn('dishes', 'cuisine_type')) {
                $table->dropColumn('cuisine_type');
            }

            // نضيف عمود جديد للربط بجدول التصنيفات
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dishes', function (Blueprint $table) {
            // في حالة الرجوع للخلف
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // نرجع العمود القديم إن أردت
            $table->string('cuisine_type')->nullable();
        });
    }
};
