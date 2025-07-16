<?php

namespace App\Http\Controllers\Cook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cook;
use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;

class ProfileController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $cook = Auth::user()->cook;
        $categories = Category::all();
        $cities = City::all();
        return view('cook.profile', compact('cook', 'categories', 'cities', 'countries'));
    }

    public function edit()
    {
        $countries = Country::all();
        $cook = Auth::user()->cook;
        $categories = Category::all();
        $cookCategories = $cook->categories->pluck('id')->toArray();
        $cities = City::all();

        return view('cook.profile', compact('cook', 'categories', 'cookCategories', 'cities'));
    }

    public function update(Request $request)
    {
        $cook = Auth::user()->cook;

        $request->validate([
            'full_name'   => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email'],
            'country_id'  => ['nullable', 'integer', 'exists:countries,id'],
            'city_id'     => ['nullable', 'integer', 'exists:cities,id'],
            'categories'  => ['nullable', 'array'],
            'categories.*'=> ['integer', 'exists:categories,id'],
            'avatar'      => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);

        // تحديث البيانات الأساسية
        $cook->full_name = $request->full_name;
        $cook->email     = $request->email;
        $cook->country_id = $request->country_id;
        $cook->city_id   = $request->city_id;

        // معالجة رفع الصورة
        if ($request->hasFile('avatar')) {
            if ($cook->avatar) {
                Storage::disk('public')->delete($cook->avatar); // حذف القديمة
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $cook->photo = $path;
        }

        $cook->save();

        // مزامنة أنواع الأكل
        $cook->categories()->sync($request->categories ?? []);

        return redirect()->route('cook.profile.edit')->with('success', 'تم تحديث معلوماتك بنجاح');
    }
}
