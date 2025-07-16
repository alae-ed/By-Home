<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    public function country()
{
    return $this->belongsTo(Country::class);
}

    // الحقول لي نقدرو نعمرهم
    protected $fillable = ['name'];

    // العلاقة مع الزبناء (clients)
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function users()
{
    return $this->hasMany(User::class);
}

    // العلاقة مع الطباخين (cooks)
    public function cooks()
    {
        return $this->hasMany(Cook::class);
    }
}
