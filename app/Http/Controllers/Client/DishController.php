<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(Request $request)
    {
        // جلب جميع الدول مع مدنها مرتبة
        $countries = Country::with(['cities' => function($query) {
            $query->orderBy('name');
        }])->orderBy('name')->get()->keyBy('id');

        // بناء الاستعلام الأساسي
        $dishesQuery = Dish::with(['cook', 'category'])
            ->whereHas('cook', function ($query) use ($request) {
                $query->where('role', 'cook');

                // فلترة حسب المدينة إذا كانت محددة
                if ($request->filled('city')) {
                    $query->where('city_id', $request->city);
                }
                // فلترة حسب الدولة إذا كانت محددة
                elseif ($request->filled('country')) {
                    $query->whereHas('city', function($q) use ($request) {
                        $q->where('country_id', $request->country);
                    });
                }
            });

        // تطبيق الفلترات الإضافية
        if ($request->filled('search')) {
            $dishesQuery->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $dishesQuery->where('category_id', $request->category);
        }

        // الحصول على النتائج النهائية
        $dishes = $dishesQuery->orderBy('created_at', 'desc')->paginate(12);

        return view('client.dishes.index', [
            'dishes' => $dishes,
            'categories' => Category::all(),
            'countries' => $countries, // نمرر الدول مع مدنها
            'selectedCountry' => $request->country,
            'selectedCity' => $request->city,
        ]);
    }
}

