<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'client_id',
        'cook_id',
        'rating',
        'comment',
    ];

    // العلاقة مع العميل (Client)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع الطباخ (Cook)
    public function cook()
    {
        return $this->belongsTo(Cook::class);
    }
}

