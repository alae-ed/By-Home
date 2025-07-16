<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory;

    // الحقول اللي نسمحو بإدخالهم من الفورم أو request
    protected $fillable = [
        'cook_id',
        'category_id',
        'name',
        'description',
        'price',
        'image'
    ];

    // كل طبق كينتمي لطباخ واحد
    public function cook()
    {
        /*return $this->belongsTo(Cook::class);
        return $this->belongsTo(User::class, 'cook_id');*/
        return $this->belongsTo(User::class, 'cook_id');
    }

    // كل طبق كينتمي لفئة واحدة
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // كل طبق يقدرو يطلبوه بزاف ديال العملاء (عبر جدول orders)
public function orders()
{
    return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
}

public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'dish_id', 'client_id')->withTimestamps();
    }
    

}
