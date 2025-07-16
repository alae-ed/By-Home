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
    Schema::table('cities', function (Blueprint $table) {
        $table->foreignId('country_id')->after('id')->nullable()->constrained();
    });

    // ربط المدن الموجودة بالبلدان (افتراضي المغرب)
    DB::table('cities')->update(['country_id' => 1]); // 1 = المغرب
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            //
        });
    }
};
