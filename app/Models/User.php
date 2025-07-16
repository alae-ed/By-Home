<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'client' أو 'cook'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // العلاقة مع الطباخ (إذا كان role = cook)
    public function cook()
    {
        return $this->hasOne(Cook::class);
    }

    // العلاقة مع المستخدم الزبون (إذا كان role = client)
    public function client()
    {
        return $this->hasOne(Client::class);
    }
    // العلاقة مع الطلبات
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }
    public function city()
{
    return $this->belongsTo(City::class);
}
    public function country()
{
    return $this->belongsTo(Country::class);
 
}
public function favorites()
{
    return $this->belongsToMany(Dish::class, 'favorites', 'client_id', 'dish_id')->withTimestamps();
}

public function hasFavorited($dishId)
{
    return $this->favorites()->where('dish_id', $dishId)->exists();
}

}