<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Cook;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDishes = Dish::where('price', '<', 50)->take(6)->get();
        $topCooks = Cook::withCount('dishes')->orderByDesc('dishes_count')->take(6)->get();
        $mostOrderedDishes = Dish::withCount('orders')->orderByDesc('orders_count')->take(6)->get();
    
        return view('home', [
            'specialOffers' => $featuredDishes,
            'topCooks' => $topCooks,
            'popularDishes' => $mostOrderedDishes,
        ]);
        
    }
}

