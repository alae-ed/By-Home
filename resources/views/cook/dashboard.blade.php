@extends('layouts.chef')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- الترحيب وتحذير الملف الشخصي -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ __('مرحباً بك،') }}{{ Auth::user()->name }} 👋</h1>
            <p class="text-gray-600 mt-2">{{ __('نظرة عامة على أدائك اليومي') }}</p>
        </div>
        
        @if (!$isProfileComplete)
        <div class="bg-amber-50 border-l-4 border-amber-400 p-4 mt-4 md:mt-0 w-full md:w-auto">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-amber-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <p class="text-amber-800">{{ __('ملفك الشخصي غير مكتمل.') }} <a href="{{ route('cook.profile') }}" class="text-amber-600 font-medium hover:text-amber-700">{{ __('أكمل معلوماتك الآن') }}</a></p>
            </div>
        </div>
        @endif
    </div>

    <!-- بطاقات الإحصائيات -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- طلبات اليوم -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('طلبات اليوم') }}</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $todayOrders }}</h3>
                </div>
                <div class="bg-blue-50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- الأرباح الكلية -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('الأرباح الكلية') }}</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalEarnings, 2) }} <span class="text-sm">{{ __('درهم') }}</span></h3>
                </div>
                <div class="bg-green-50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- الأطباق المباعة -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('الأطباق المباعة') }}</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $soldDishes }}</h3>
                </div>
                <div class="bg-purple-50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- متوسط التقييم -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('متوسط التقييم') }}</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1 flex items-center">
                        {{ number_format($avgRating, 1) }}
                        <span class="text-yellow-400 ml-1">★</span>
                    </h3>
                </div>
                <div class="bg-amber-50 p-3 rounded-full">
                    <svg class="h-6 w-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- مخطط المبيعات -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">{{ __('مبيعات الشهور الأخيرة') }}</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-sm bg-blue-50 text-blue-600 rounded-full">{{ __('سنوي') }}</button>
                <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-50 rounded-full">{{ __('شهري') }}</button>
                <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-50 rounded-full">{{ __('أسبوعي') }}</button>
            </div>
        </div>
        <div class="h-80">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js "></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    @foreach(range(1, 12) as $m)
                        "{{ \Carbon\Carbon::create()->month($m)->locale('fr')->monthName }}",
                    @endforeach
                ],
                datasets: [{
                    label: '{{ __('المبيعات بالدرهم') }}',
                    data: [
                        @foreach(range(1, 12) as $m)
                            {{ $monthlySales[$m] ?? 0 }},
                        @endforeach
                    ],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointBackgroundColor: '#3B82F6',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' {{ __('درهم') }}';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: '#f3f4f6'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' {{ __('درهم') }}';
                            },
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    });
</script>
@endsection