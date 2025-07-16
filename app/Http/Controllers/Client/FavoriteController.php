<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $dishId = $request->input('dish_id');
        $client = auth()->user(); // ✅ هذا هو الصحيح

        if ($client->hasFavorited($dishId)) {
            $client->favorites()->detach($dishId);
            return response()->json(['status' => 'removed']);
        } else {
            $client->favorites()->attach($dishId);
            return response()->json(['status' => 'added']);
        }
    }

    public function index()
    {
        $user = auth()->user();
        $dishes = $user->favorites()->with('cook')->paginate(12);

        return view('client.favorites.index', compact('dishes'));
    }
}
