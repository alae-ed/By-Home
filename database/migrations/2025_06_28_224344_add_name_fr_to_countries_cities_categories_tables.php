<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('name_fr')->nullable()->after('name');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('name_fr')->nullable()->after('name');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_fr')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('name_fr');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('name_fr');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_fr');
        });
    }
};
