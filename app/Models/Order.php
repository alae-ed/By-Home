<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'cook_id',
        //'dish_id',
        'status',
        'address',
    ];

    // علاقة مع العميل
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function dishes()
{
    return $this->belongsToMany(Dish::class, 'dish_order', 'order_id', 'dish_id')
        ->withPivot('quantity')
        ->withTimestamps();
}


    // الطلب يحتوي على عناصر (تفاصيل الكمية وغيرها)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function items()
    {
        return $this->orderItems();
    }
}
