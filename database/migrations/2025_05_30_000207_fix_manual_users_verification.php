<?php


use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        User::whereNull('email_verified_at')->update([
            'email_verified_at' => now(),
        ]);
        
        User::whereNull('remember_token')->update([
            'remember_token' => Str::random(10)
        ]);
    }
};