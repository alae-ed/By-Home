<div class="order-card border p-4 mb-4 rounded bg-white shadow">
    <p><strong>{{ __('الطلب رقم:') }}</strong> {{ $order->id }}</p>
    <p><strong>{{ __('الزبون:') }}</strong> {{ $order->client->name }}</p>
    <p><strong>{{ __('الحالة:') }}</strong> {{ $order->status }}</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
        @foreach($order->dishes as $dish)
        <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
            <div class="h-40 overflow-hidden">
                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-full object-cover">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $dish->name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ $dish->description ?? 'بدون وصف' }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-orange-600 font-bold">{{ $dish->price }} {{ __('درهم') }}</span>
                    <span class="text-sm text-gray-600">{{ __('الكمية:') }} {{ $dish->pivot->quantity }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <p class="mt-4"><strong>{{ __('العنوان:') }}</strong> {{ $order->address }}</p>

    {{-- ✅ فورم تحديث الحالة --}}
    <form action="{{ route('cook.orders.update', $order->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PUT')
        <select name="status" class="border px-2 py-1 rounded">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{ __('معلق') }}</option>
            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>{{ __('قيد التحضير') }}</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>{{ __('مكتمل') }}</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">{{ __('تحديث') }}</button>
    </form>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif