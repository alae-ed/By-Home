<?php

namespace App\Http\Controllers\Cook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cookId = Auth::id();

        // عدد الطلبات اليومية
        $todayOrders = Order::where('cook_id', $cookId)
                            ->whereDate('created_at', now()->toDateString())
                            ->count();

        // عدد الوجبات المباعة (عدد الطلبات المكتملة)
        $soldDishes = Order::where('cook_id', $cookId)
                           ->where('status', 'completed')
                           ->count();

        // إجمالي الأرباح يتم حسابه بجمع ثمن كل طبق مضروبًا في عدد مرات طلبه
        $dishes = Dish::where('cook_id', $cookId)->withCount(['orders' => function ($query) {
            $query->where('status', 'completed');
        }])->get();

        $totalEarnings = $dishes->sum(function ($dish) {
            return $dish->price * $dish->orders_count;
        });

        // تقييمات العملاء
        $dishIds = $dishes->pluck('id');
        $avgRating = Review::whereIn('dish_id', $dishIds)->avg('rating') ?? 0;

        // التحقق من اكتمال الملف الشخصي
        $isProfileComplete = Auth::user()->name && Auth::user()->city && Auth::user()->phone && Auth::user()->email;
        if (!$isProfileComplete) {
            session()->flash('warning', 'يرجى إكمال ملفك الشخصي قبل استخدام لوحة التحكم.');
        }

        return view('cook.dashboard', compact(
            'todayOrders',
            'totalEarnings',
            'soldDishes',
            'avgRating',
            'isProfileComplete'
        ));
    }
}