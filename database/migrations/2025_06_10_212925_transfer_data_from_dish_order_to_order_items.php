<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Dish;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    $pivotData = DB::table('dish_order')->get();
    
    foreach ($pivotData as $pivot) {
        DB::table('order_items')->insert([
            'order_id' => $pivot->order_id,
            'dish_id' => $pivot->dish_id,
            'quantity' => $pivot->quantity,
            'price_at_order' => Dish::find($pivot->dish_id)->price, // نسحب السعر الحالي للطبق
            'created_at' => $pivot->created_at,
            'updated_at' => $pivot->updated_at,
        ]);
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
