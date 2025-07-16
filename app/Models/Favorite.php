<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    // الحقول لي نقدرو نعمرهم
    protected $fillable = [
        'client_id',
        'cook_id',
    ];

    // العلاقة مع العميل
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع الطباخ
    public function cook()
    {
        return $this->belongsTo(Cook::class);
    }
}
