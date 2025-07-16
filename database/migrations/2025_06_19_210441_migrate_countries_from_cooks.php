<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // 1. إنشاء دول جديدة غير موجودة
    $existingCountries = DB::table('cooks')
        ->select('country')
        ->distinct()
        ->whereNotNull('country')
        ->get()
        ->pluck('country');

    foreach ($existingCountries as $country) {
        DB::table('countries')->updateOrInsert(
            ['name' => $country],
            ['name' => $country]
        );
    }

    // 2. تحديث جدول الطباخين
    Schema::table('cooks', function (Blueprint $table) {
        $table->foreignId('country_id')->after('country')->nullable()->constrained('countries');
    });

    // 3. ربط الطباخين بالدول الجديدة
    $cooks = DB::table('cooks')->whereNotNull('country')->get();
    foreach ($cooks as $cook) {
        $countryId = DB::table('countries')
            ->where('name', $cook->country)
            ->value('id');
        
        DB::table('cooks')
            ->where('id', $cook->id)
            ->update(['country_id' => $countryId]);
    }

    // 4. حذف العمود القديم (اختياري)
    Schema::table('cooks', function (Blueprint $table) {
        $table->dropColumn('country');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cooks', function (Blueprint $table) {
            //
        });
    }
};
