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
        
        Schema::dropIfExists('clients');
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ⬅️ هذا هو السطر لي زدناه
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null'); // ⬅️ هذا هو السطر لي زدناه
            $table->timestamps();
        });
    }
};
