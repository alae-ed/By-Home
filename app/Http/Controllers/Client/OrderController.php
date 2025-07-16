<?php



namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;



class OrderController extends Controller
{
    /**
     * عرض قائمة الطلبات
     */
    public function index(Request $request)
{
    $status = $request->get('status'); // يمكن أن يكون "نشط" أو "مكتمل" أو null

    $orders = Order::where('client_id', Auth::id())
        ->when($status, function ($query, $status) {
            $query->where('status', $status);
        })
        ->with('orderItems.dish')
        ->latest()
        ->get();

    return view('client.orders.index', compact('orders', 'status'));
}
    /**
     * عرض صفحة إنشاء طلب جديد - الدالة المفقودة
     */
    public function create($cook, $dish)
{
    $cook = User::where('role', 'cook')->findOrFail($cook);
    $dish = Dish::with('cook')->findOrFail($dish); // تحميل العلاقة مسبقًا

    if ($dish->cook_id != $cook->id) {
        abort(404, 'هذا الطبق لا ينتمي لهذا الطباخ');
    }
    
    return view('client.orders.create', [
        'cook' => $cook,
        'dish' => $dish,
        'deliveryAreas' => $cook->delivery_areas // إضافة إذا كان هناك مناطق توصيل
    ]);
}

    /**
     * حفظ الطلب الجديد - مع التصحيحات
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cook_id' => 'required|exists:users,id,role,cook',
            'dish_id' => [
                'required',
                'exists:dishes,id',
                function ($attribute, $value, $fail) use ($request) {
                    $dish = Dish::find($value);
                    if ($dish && $dish->cook_id != $request->cook_id) {
                        $fail('الطبق المحدد لا ينتمي لهذا الطباخ');
                    }
                }
            ],
            'quantity' => 'required|integer|min:1|max:10',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500'
        ]);
    
        DB::beginTransaction();
        try {
            $order = Order::create([
                'client_id' => Auth::id(),
                'cook_id' => $validated['cook_id'],
                'status' => 'pending',
                'address' => $validated['address'],
                'total' => 0
            ]);
    
            $dish = Dish::find($validated['dish_id']);
    
            // ✨ تسجيل عنصر الطلب
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $dish->id,
                'quantity' => $validated['quantity'],
                'price_at_order' => $dish->price,
                'notes' => $validated['notes'] ?? null
            ]);
    
            // ✨ ربط الطلب بالطبق (لعرضه في صفحة الطباخ)
            $order->dishes()->attach($dish->id, [
                'quantity' => $validated['quantity']
            ]);
    
            // ✨ تحديث المجموع الكلي
            $order->update([
                'total' => $orderItem->quantity * $orderItem->price_at_order
            ]);
    
            DB::commit();
    
            return redirect()->route('client.dashboard')
                ->with('success', 'La commande a été créée avec succès !');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء إنشاء الطلب: ' . $e->getMessage());
        }
    }
}