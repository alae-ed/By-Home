<?php

namespace App\Services;

use App\Models\Dish;
use App\Models\Favorite;
use Illuminate\Support\Collection;

class RecommendationService
{
    // جلب اقتراحات للعميل
    public static function getForClient(int $clientId): Collection
    {
        // جلب الأطباق المفضلة للعميل
        $favoriteIds = Favorite::where('client_id', $clientId)->pluck('dish_id');

        // اقتراح أطباق مشابهة (نفس الفئة أو عشوائية إن لم توجد)
        if ($favoriteIds->isNotEmpty()) {
            return Dish::whereNotIn('id', $favoriteIds)
                ->inRandomOrder()
                ->take(5)
                ->get();
        }

        // إذا لم يكن عنده مفضلات، نعرض أطباق عشوائية
        return Dish::inRandomOrder()
            ->take(5)
            ->get();
    }

    // تحديث الاقتراحات (اختياري لو كنت تخزنها في جدول)
    public static function refresh(int $clientId): void
    {
        // هذا فقط placeholder — عدّله حسب منطق التخزين الخاص بك
        // يمكنك مثلاً حفظها في جدول recommendations
    }
}
