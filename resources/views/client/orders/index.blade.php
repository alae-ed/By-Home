@extends('layouts.client')
@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- العنوان مع تأثير أكثر أناقة -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            {{ $status == 'مكتمل' ? __('الطلبات السابقة') : __('الطلبات النشطة') }}
        </h1>
        <div class="w-20 h-1 bg-gradient-to-r from-orange-400 to-blue-400 rounded-full"></div>
    </div>

    <!-- روابط الفلترة بتصميم أكثر عصرية -->
    <div class="mb-8 flex gap-2 bg-gray-50 p-1 rounded-full w-fit">
        <a href="{{ route('client.orders.index', ['status' => 'pending']) }}"
           class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $status == 'نشط' ? 'bg-white text-orange-600 shadow-sm' : 'text-gray-600 hover:text-orange-600' }}">
            {{ __('الطلبات النشطة') }}
        </a>
        <a href="{{ route('client.orders.index', ['status' => 'completed']) }}"
           class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $status == 'مكتمل' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-blue-600' }}">
            {{ __('الطلبات السابقة') }}
        </a>
    </div>

    <!-- قائمة الطلبات بتصميم كروت أكثر حداثة -->
    @forelse($orders as $order)
    <div class="mb-6 p-6 bg-white rounded-2xl shadow-xs border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-transparent">
        <!-- رأس البطاقة -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-5 gap-4">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <h2 class="font-bold text-gray-900 text-lg">{{ __('طلب رقم') }} #{{ $order->id }}</h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        {{ $order->status == 'مكتمل' ? 'bg-green-50 text-green-600' : 
                           ($order->status == 'ملغى' ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }}">
                        {{ __($order->status) }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $order->created_at->translatedFormat(__('l j F Y - H:i')) }}
                </p>
            </div>
            
            <div class="flex flex-col items-end">
                <span class="text-xl font-bold text-gray-800">{{ number_format($order->total, 2) }} {{ __('درهم') }}</span>
                <a href="{{ route('client.orders.show', $order->id) }}"
                   class="mt-3 inline-flex items-center px-4 py-2 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-full text-sm font-medium text-gray-700 transition-all duration-300 group">
                    {{ __('التفاصيل') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- خط فاصل أنيق -->
        <div class="border-t border-dashed border-gray-200 my-5"></div>

        <!-- تفاصيل الأطباء بتصميم شبكة أكثر تنظيمًا -->
        <div class="grid gap-5">
            @foreach($order->orderItems as $item)
                <div class="flex items-start gap-4 p-3 hover:bg-gray-50 rounded-lg transition">
                    <img src="{{ asset('storage/' . $item->dish->image) }}"
                         alt="{{ $item->dish->name }}"
                         class="w-20 h-20 rounded-xl object-cover border border-gray-200 shadow-xs">
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $item->dish->name }}</h3>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2">
                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ __('الكمية') }}: {{ $item->quantity }}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ __('السعر') }}: {{ number_format($item->price_at_order, 2) }} {{ __('درهم') }}
                            </p>
                        </div>
                        
                        @if ($item->notes)
                            <div class="mt-2 bg-blue-50 p-2 rounded-lg">
                                <p class="text-xs text-blue-600 flex items-start gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    <span>{{ __('ملاحظات') }}: {{ $item->notes }}</span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <!-- حالة عدم وجود طلبات بتصميم أكثر جاذبية -->
    <div class="text-center py-16 bg-white rounded-2xl shadow-xs border border-gray-100">
        <div class="mx-auto w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('لا توجد طلبات لعرضها') }}</h3>
        <p class="text-gray-500 max-w-md mx-auto">{{ $status == 'مكتمل' ? __('لم تقم بإكمال أي طلبات حتى الآن.') : __('ليس لديك أي طلبات نشطة حالياً.') }}</p>
    </div>
@endforelse

</div>
@endsection