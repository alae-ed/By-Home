<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // هاد الحقول مسموح لينا نعبّروهم عند الإنشاء أو التحديث
    protected $fillable = ['name'];

    // العلاقة مع الأطباق: فئة وحدة فيها بزاف ديال الأطباق
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
    public function cooks()
{
    return $this->belongsToMany(Cook::class);
}

}

