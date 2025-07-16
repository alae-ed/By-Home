<?php

namespace App\Http\Controllers\Client;

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Favorite;
use App\Services\RecommendationService; // Import the RecommendationService class

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        

        $recentOrders = $user->orders()
            ->with(['items.dish:id,name,price,image']) // هذا هو الشكل الصحيح
            ->latest()
            ->take(5)
            ->with('orderItems.dish') // تأكد من تحميل العلاقة orderItems مع dish
            ->get();

        $userId = $user->id; // Define $userId from the authenticated user's ID

        $recommendations = Dish::inRandomOrder() // أو منطق الاقتراحات الخاص بك
            ->take(3)
            ->get();

            return view('client.dashboard', [
                'activeOrdersCount' => Order::where('client_id', $userId)->where('status', 'pending')->count(),
                'previousOrdersCount' => Order::where('client_id', $userId)->where('status', 'completed')->count(),
                'favoritesCount' => Favorite::where('client_id', $userId)->count(),
                'points' => auth()->user()->loyalty_points ?? 0,
                'recommendations' => RecommendationService::getForClient($userId),
                'recentOrders' => $recentOrders,
            ]);}
}
