@extends('layouts.client')

@section('content')
@if(session('success'))
<div class="fixed top-4 right-4 z-50">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ session('success') }}
    </div>
</div>
@endif

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- رأس الصفحة مع رسالة ترحيبية -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-900">{{ __('مرحباً بك،') }} {{ Auth::user()->name }}</h1>
                <p class="text-gray-600">{{ __('إليك ملخص لنشاطك واقتراحاتنا المميزة لك') }}</p>
            </div>
            <a href="{{ route('client.dishes.index') }}" 
               class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-orange-500 to-orange-600 border border-transparent rounded-full font-medium text-white hover:shadow-lg transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                {{ __('تصفح الأطباق') }}
            </a>
        </div>

        <!-- بطاقات الإحصائيات -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- بطاقة الطلبات النشطة -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <div class="p-5 flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('الطلبات النشطة') }}</p>
                        <h3 class="mt-1 text-2xl font-bold text-gray-900">{{ $activeOrdersCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-orange-50 text-orange-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('client.orders.index', ['status' => 'pending']) }}" class="block px-5 py-3 text-sm font-medium text-orange-600 bg-orange-50 hover:bg-orange-100 transition-colors">
                    {{ __('عرض التفاصيل') }}
                </a>
            </div>

            <!-- بطاقة الطلبات السابقة -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <div class="p-5 flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('الطلبات السابقة') }}</p>
                        <h3 class="mt-1 text-2xl font-bold text-gray-900">{{ $previousOrdersCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('client.orders.index', ['status' => 'completed']) }}" class="block px-5 py-3 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                    {{ __('عرض التفاصيل') }}
                </a>
            </div>

            <!-- بطاقة المفضلة -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <div class="p-5 flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('الأطباق المفضلة') }}</p>
                        <h3 class="mt-1 text-2xl font-bold text-gray-900">{{ $favoritesCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-green-50 text-green-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('client.favorites.index') }}" class="block px-5 py-3 text-sm font-medium text-green-600 bg-green-50 hover:bg-green-100 transition-colors">
                    {{ __('عرض التفاصيل') }}
                </a>
            </div>

            <!-- بطاقة النقاط -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                <div class="p-5 flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('نقاط الولاء') }}</p>
                        <h3 class="mt-1 text-2xl font-bold text-gray-900">{{ $points }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <a href="" class="block px-5 py-3 text-sm font-medium text-purple-600 bg-purple-50 hover:bg-purple-100 transition-colors">
                    {{ __('استبدال النقاط') }}
                </a>
            </div>
        </div>

        <!-- قسم الطلبات الأخيرة -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">{{ __('طلباتك الأخيرة') }}</h2>
                <a href="{{ route('client.orders.index') }}" class="text-sm font-medium text-orange-500 hover:text-orange-700 flex items-center">
                    {{ __('عرض الكل') }}
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            @if($recentOrders->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($recentOrders as $order)
                <div class="p-5 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ __('طلب #') }}{{ $order->id }}</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $order->created_at->translatedFormat('l j F Y - H:i') }}
                                </p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status == 'مكتمل' ? 'bg-green-100 text-green-800' : ($order->status == 'ملغى' ? 'bg-red-100 text-red-800' : 'bg-orange-100 text-orange-800') }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-lg font-bold text-gray-900">{{ number_format($order->total, 2) }} {{ __('درهم') }}</span>
                            <a href="{{ route('client.orders.show', $order->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-colors">
                                {{ __('التفاصيل') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-8 text-center">
                <div class="mx-auto h-24 w-24 text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="mt-3 text-lg font-medium text-gray-900">{{ __('لا توجد طلبات بعد') }}</h3>
                <p class="mt-1 text-gray-500">{{ __('ابدأ بتصفح قائمتنا المميزة من الأطباق') }}</p>
                <div class="mt-6">
                    <a href="{{ route('client.dishes.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        {{ __('تصفح الأطباق') }}
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- قسم الاقتراحات -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">{{ __('اقتراحات لك') }}</h2>
                <button onclick="refreshRecommendations()" class="text-sm font-medium text-orange-500 hover:text-orange-700 flex items-center">
                    {{ __('تحديث الاقتراحات') }}
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
            
            @if($recommendations->count() > 0)
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recommendations as $dish)
                    <div class="group relative bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="aspect-w-3 aspect-h-2 bg-gray-100">
                            @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="object-cover w-full h-48">
                            @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            @endif
                            
                            @if($dish->discount > 0)
                            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                                {{ __('خصم') }} {{ $dish->discount }}%
                            </span>
                            @endif
                            
                            <button class="absolute top-3 left-3 bg-white/90 text-gray-900 p-2 rounded-full shadow-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 truncate">{{ $dish->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $dish->cook->name ?? __('طاهٍ غير معروف') }}</p>
                            
                            <div class="mt-3 flex items-center justify-between">
                                <div>
                                    @if($dish->discount > 0)
                                    <span class="text-sm text-gray-400 line-through mr-2">{{ number_format($dish->price, 2) }} {{ __('درهم') }}</span>
                                    @endif
                                    <span class="font-bold text-orange-600">{{ number_format($dish->discount > 0 ? $dish->price - ($dish->price * $dish->discount / 100) : $dish->price, 2) }} {{ __('درهم') }}</span>
                                </div>
                                
                                <button class="text-orange-500 hover:text-orange-700 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="p-8 text-center">
                <div class="mx-auto h-24 w-24 text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="mt-3 text-lg font-medium text-gray-900">{{ __('لا توجد اقتراحات متاحة حالياً') }}</h3>
                <p class="mt-1 text-gray-500">{{ __('سنقوم باقتراح أطباق تناسب ذوقك قريباً') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function refreshRecommendations() {
        // إظهار مؤشر تحميل
        const recommendationsSection = document.querySelector('#recommendations-section');
        recommendationsSection.innerHTML = `
            <div class="p-8 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-orange-500 mx-auto"></div>
                <p class="mt-4 text-gray-600">{{ __('جاري تحديث الاقتراحات...') }}</p>
            </div>
        `;
        
        // طلب AJAX لتحديث الاقتراحات
        fetch('', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            // هنا يمكنك تحديث القسم بالبيانات الجديدة
            window.location.reload();
        })
        .catch(error => {
            recommendationsSection.innerHTML = `
                <div class="p-8 text-center text-red-500">
                    {{ __('حدث خطأ أثناء تحديث الاقتراحات. يرجى المحاولة لاحقاً.') }}
                </div>
            `;
        });
    }
</script>
@endpush

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection