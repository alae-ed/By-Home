<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city_id',
    ];

    // العلاقة مع المدينة
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // العلاقة مع الطلبات
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // العلاقة مع المفضلات
    public function favorites()
    {
        return $this->belongsToMany(Dish::class, 'favorites', 'client_id', 'dish_id')->withTimestamps();
    }
    public function hasFavorited($dishId)
{
    return $this->favorites()->where('dish_id', $dishId)->exists();
}

    // العلاقة مع التقييمات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

