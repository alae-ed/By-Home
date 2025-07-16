<?php

namespace App\Http\Controllers\Cook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        //$cookId = Auth::guard('cook')->id(); // تأكدنا من استخدام حارس الطباخ
        $cookId = Auth::id(); // استخدام معرف المستخدم الحالي (الطباخ) مباشرة

        // ⬇️ فقط مؤقتًا للتصحيح
    /*dd(
        Order::with('dishes')->get()->map(function ($order) {
            return [
                'order_id' => $order->id,
                'dish_ids' => $order->dishes->pluck('id'),
                'cook_ids' => $order->dishes->pluck('cook_id'),
            ];
        })
    );*/
    //debugging
    /*dd([
        'cook_id_logged_in' => $cookId,
        'orders' => Order::with('dishes')->get()->map(function ($order) {
            return [
                'order_id' => $order->id,
                'dish_ids' => $order->dishes->pluck('id'),
                'cook_ids' => $order->dishes->pluck('cook_id'),
            ];
        }),
    ]);*/

        $ordersByStatus = fn($status) =>
            Order::where('status', $status)
                ->whereHas('dishes', function ($query) use ($cookId) {
                    $query->where('cook_id', $cookId);
                })
                ->with(['dishes', 'client'])
                ->latest()
                ->get();

        return view('cook.orders.index', [
            'pendingOrders' => $ordersByStatus('pending'),
            'preparingOrders' => $ordersByStatus('preparing'),
            'completedOrders' => $ordersByStatus('completed'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,completed',
        ]);

        $order = Order::with('dishes')->findOrFail($id);

//$cookId = Auth::guard('cook')->id();
$cookId = Auth::id(); // ✅


// تحقق من أن الطلب يحتوي على طبق واحد على الأقل للطباخ الحالي
$hasDishFromCook = $order->dishes->contains(function ($dish) use ($cookId) {
    return $dish->cook_id == $cookId;
});

if (!$hasDishFromCook) {
    return redirect()->back()->with('error', 'ليس لديك صلاحية لتعديل هذا الطلب.');
}

$order->status = $request->status;
$order->save();

return redirect()->back()->with('success', "L'état de la commande a été mis à jour avec succès.");
    }
    

    
}
