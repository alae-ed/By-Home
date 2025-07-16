@extends('layouts.chef')

@section('content')
<div class="container">

    {{-- ✅ الطلبات المعلقة --}}
    <h2 class="text-xl font-semibold mb-2">{{ __('طلبات معلقة') }}</h2>
    <div>
        @forelse ($pendingOrders as $order)
            @include('cook.orders.partials.order-card', ['order' => $order])
        @empty
            <p class="text-gray-500">{{ __('لا توجد طلبات معلقة.') }}</p>
        @endforelse
    </div>

    {{-- ✅ الطلبات قيد التحضير --}}
    <h2 class="text-xl font-semibold mb-2 mt-6">{{ __('طلبات قيد التحضير') }}</h2>
    <div>
        @forelse ($preparingOrders as $order)
            @include('cook.orders.partials.order-card', ['order' => $order])
        @empty
            <p class="text-gray-500">{{ __('لا توجد طلبات قيد التحضير.') }}</p>
        @endforelse
    </div>

    {{-- ✅ الطلبات المكتملة --}}
    <h2 class="text-xl font-semibold mb-2 mt-6">{{ __('طلبات مكتملة') }}</h2>
    <div>
        @forelse ($completedOrders as $order)
            @include('cook.orders.partials.order-card', ['order' => $order])
        @empty
            <p class="text-gray-500">{{ __('لا توجد طلبات مكتملة.') }}</p>
        @endforelse
    </div>

</div>
@endsection
