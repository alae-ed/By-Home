<?php

namespace App\Http\Controllers\Cook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class DishController extends Controller
{
    public function index()
    {
        $cookId = Auth::id();
        $dishes = Dish::where('cook_id', $cookId)->latest()->get();

        return view('cook.dishes.index', compact('dishes'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('cook.dishes.create', compact('categories'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048',
        'category_id' => ['required', 'exists:categories,id'],
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('dishes', 'public');
    }

    Dish::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'cook_id' => Auth::id(),
        'image' => $imagePath,
    ]);

    return redirect()->route('cook.dishes.index')->with('success', 'تم إضافة الطبق بنجاح');
}


    public function edit(Dish $dish)
    {
        // تأكد أن الطباخ هو لي كيعرض الطبق
        if ($dish->cook_id !== Auth::id()) {
            return redirect()->route('cook.dishes.index')->with('error', 'ما عندكش الصلاحية لعرض هاد الطبق');
        }

        return view('cook.dishes.edit', compact('dish'));
    }
    public function update(Request $request, Dish $dish)
    {
        // تأكد أن الطباخ هو لي كيعرض الطبق
        if ($dish->cook_id !== Auth::id()) {
            return redirect()->route('cook.dishes.index')->with('error', 'ما عندكش الصلاحية لتحديث هاد الطبق');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'cuisine_type' => 'required|string|max:255',
        ]);

        $imagePath = $dish->image;
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($dish->image) {
                \Storage::disk('public')->delete($dish->image);
            }
            $imagePath = $request->file('image')->store('dishes', 'public');
        }

        // تحديث الطبق
        $dish->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'cuisine_type' => $request->cuisine_type,
        ]);

        return redirect()->route('cook.dishes.index')->with('success', 'تم تحديث الطبق بنجاح');
    }
    public function destroy(Dish $dish)
    {
        // تأكد أن الطباخ هو لي كيعرض الطبق
        if ($dish->cook_id !== Auth::id()) {
            return redirect()->route('cook.dishes.index')->with('error', 'ما عندكش الصلاحية لحذف هاد الطبق');
        }

        // حذف الصورة إذا كانت موجودة
        if ($dish->image) {
            \Storage::disk('public')->delete($dish->image);
        }

        // حذف الطبق
        $dish->delete();

        return redirect()->route('cook.dishes.index')->with('success', 'تم حذف الطبق بنجاح');
    }
    protected function authorizeDish(Dish $dish)
{
    if ($dish->cook_id !== auth()->id()) {
        abort(403);
    }
}

public function search(Request $request)
{
    $dishes = Dish::where('name', 'like', '%'.$request->q.'%')->get();
    return view('client.dishes.index', compact('dishes'));
}
    // هنا غادي نزيدو باقي methods بحال show، search، وغيرها حسب الحاجة



    // باقي methods غادي نزيدوهم وحدة بوحدة
}

