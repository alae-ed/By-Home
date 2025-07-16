<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //use HasFactory;
    
    public function cities()
{
    return $this->hasMany(City::class);
}

public function cooks()
{
    return $this->hasMany(Cook::class);
}
}
