<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'country',
        'city_id',
        'email',
        'food_types',
        'sample_image',
    ];

    protected $casts = [
        'food_types' => 'array', // تحويل تلقائي بين JSON وarray
    ];
    

    // طباخ مرتبط بمستخدم (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //country
    public function country()
{
    return $this->belongsTo(Country::class);
}

    // طباخ كينتمي لمدينة وحدة
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // طباخ عندو بزاف ديال الأطباق
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // طباخ عندو تقييمات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_cook');
    }
    
    
}
