@extends('layouts.client')
@section('content')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js "></script>
@endpush

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- شريط البحث والعنوان -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ __('استكشف الأطباق اللذيذة') }}</h1>
                <p class="mt-2 text-gray-600">{{ __('اختر من بين تشكيلتنا المميزة من الأطباق المعدة بعناية') }}</p>
            </div>
            <!-- نموذج البحث -->
            <form method="GET" action="{{ route('client.dishes.index') }}" class="mb-8">
                <div class="flex flex-wrap gap-4 items-center">
                    {{-- الدولة --}}
                    <div>
                        <label for="country-select" class="block text-sm text-gray-700 mb-1">{{ __('الدولة') }}</label>
                        <select name="country" id="country-select" onchange="updateCities()" class="px-4 py-2 rounded-md border-gray-300 focus:ring-orange-500">
                            <option value="">{{ __('كل الدول') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- المدينة --}}
                    <div>
                        <label for="city-select" class="block text-sm text-gray-700 mb-1">{{ __('المدينة') }}</label>
                        <select name="city" id="city-select" class="px-4 py-2 rounded-md border-gray-300 focus:ring-orange-500">
                            <option value="">{{ __('كل المدن') }}</option>
                            @if(request('country'))
                                @foreach($countries[request('country')]->cities as $city)
                                    <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                                        {{ $city->{'name_' . app()->getLocale()} }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- نوع الأكل --}}
                    <div>
                        <label for="category" class="block text-sm text-gray-700 mb-1">{{ __('نوع الأكل') }}</label>
                        <select name="category" id="category" class="px-4 py-2 rounded-md border-gray-300 focus:ring-orange-500">
                            <option value="">{{ __('كل الأنواع') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- زر البحث --}}
                    <div>
                        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600">
                            {{ __('بحث') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- فلترة حسب التصنيفات المحسنة -->
        <div class="mb-8">
            {{-- عرض الفلاتر النشطة --}}
            @if(request()->hasAny(['category', 'country', 'city']))
                <div class="mb-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span class="text-sm font-medium text-blue-800">{{ __('الفلاتر النشطة:') }}</span>
                        </div>
                        <a href="{{ route('client.dishes.index') }}" 
                           class="text-xs text-blue-600 hover:text-blue-800 underline">
                            {{ __('مسح جميع الفلاتر') }}
                        </a>
                    </div>
                    <div class="mt-2 flex flex-wrap gap-2">
                        {{-- فلتر الدولة --}}
                        @if(request('country'))
                            @php
                                $selectedCountry = $countries->find(request('country'));
                            @endphp
                            @if($selectedCountry)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $selectedCountry->name }}
                                    <a href="{{ request()->fullUrlWithQuery(['country' => null, 'city' => null]) }}" 
                                       class="mr-1 text-green-600 hover:text-green-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif
                        @endif
                        {{-- فلتر المدينة --}}
                        @if(request('city'))
                            @php
                                $selectedCity = null;
                                if(request('country')) {
                                    $country = $countries->find(request('country'));
                                    if($country) {
                                        $selectedCity = $country->cities->find(request('city'));
                                    }
                                }
                            @endphp
                            @if($selectedCity)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    {{ $selectedCity->name }}
                                    <a href="{{ request()->fullUrlWithQuery(['city' => null]) }}" 
                                       class="mr-1 text-purple-600 hover:text-purple-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif
                        @endif
                        {{-- فلتر التصنيف --}}
                        @if(request('category'))
                            @php
                                $selectedCategory = $categories->find(request('category'));
                            @endphp
                            @if($selectedCategory)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $selectedCategory->name }}
                                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" 
                                       class="mr-1 text-orange-600 hover:text-orange-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
            {{-- أزرار التصنيفات --}}
            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('تصفية حسب نوع الأكل') }}</h3>
                    {{-- زر إظهار/إخفاء جميع التصنيفات --}}
                    <button id="toggleCategories" class="text-sm text-blue-600 hover:text-blue-800 underline focus:outline-none">
                        <span id="toggleText">{{ __('عرض المزيد') }}</span>
                    </button>
                </div>
                <div class="category-filters">
                    <div class="flex flex-wrap gap-2">
                        {{-- زر "الكل" --}}
                        <a href="{{ route('client.dishes.index', request()->except('category')) }}" 
                           class="px-4 py-2 rounded-full transition-colors duration-200 {{ !request('category') ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            {{ __('الكل') }}
                        </a>
                        {{-- التصنيف المختار (إن وجد) --}}
                        @if(request('category'))
                            @php
                                $selectedCategory = $categories->find(request('category'));
                            @endphp
                            @if($selectedCategory)
                                <a href="{{ route('client.dishes.index', request()->except('category')) }}" 
                                   class="px-4 py-2 rounded-full bg-orange-500 text-white hover:bg-orange-600 transition-colors duration-200">
                                    {{ $selectedCategory->name }}
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            @endif
                        @endif
                        {{-- أول 5 تصنيفات (دائماً مرئية) --}}
                        <div id="visibleCategories" class="flex flex-wrap gap-2">
                            @foreach($categories->take(5) as $category)
                                @if(!request('category') || request('category') != $category->id)
                                    <a href="{{ route('client.dishes.index', array_merge(request()->except('category'), ['category' => $category->id])) }}" 
                                       class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors duration-200">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        {{-- باقي التصنيفات (مخفية افتراضياً) --}}
                        @if($categories->count() > 5)
                            <div id="hiddenCategories" class="hidden flex-wrap gap-2 mt-2">
                                @foreach($categories->skip(5) as $category)
                                    @if(!request('category') || request('category') != $category->id)
                                        <a href="{{ route('client.dishes.index', array_merge(request()->except('category'), ['category' => $category->id])) }}" 
                                           class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors duration-200">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقات الأطباق -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($dishes as $dish)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                    <!-- صورة الطبق -->
                    <div class="relative h-48 overflow-hidden">
                        @if (auth()->check())
                            <button type="button"
                                class="absolute top-2 left-2 z-10 favorite-button text-xl transition-all"
                                data-dish-id="{{ $dish->id }}"
                                style="color: {{ auth()->user()->hasFavorited($dish->id) ? '#ef4444' : '#d1d5db' }};">
                                <i class="fas fa-heart"></i>
                            </button>
                        @endif
                        @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" 
                                 class="w-full h-full object-cover" 
                                 alt="{{ $dish->name }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        @if($dish->discount > 0)
                            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ __('خصم') }} {{ $dish->discount }}%
                            </span>
                        @endif
                    </div>
                    <!-- محتوى البطاقة -->
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-gray-900">{{ $dish->name }}</h3>
                            <span class="text-orange-500 font-bold">
                                {{ $dish->discount > 0 ? number_format($dish->price - ($dish->price * $dish->discount / 100), 2) : number_format($dish->price, 2) }}
                                <span class="text-sm">{{ __('درهم') }}</span>
                            </span>
                        </div>
                        <p class="mt-2 text-gray-600 line-clamp-2">{{ Str::limit($dish->description, 60) }}</p>
                        <div class="mt-4 flex items-center">
                            @if($dish->cook && $dish->cook->profile_photo_path)
                                <img src="{{ asset('storage/' . $dish->cook->profile_photo_path) }}" 
                                     class="w-8 h-8 rounded-full object-cover mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4a4 4 0 100 8 4 4 0 000-8zm0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z"></path>
                                    </svg>
                                </div>
                            @endif
                            <span class="text-sm text-gray-700">
                                {{ $dish->cook ? $dish->cook->name : __('غير معروف') }}
                            </span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            @if($dish->cook)
                                <a href="{{ route('client.orders.create', ['cook' => $dish->cook_id, 'dish' => $dish->id]) }}" 
                                   class="w-full inline-flex justify-center items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-medium text-white hover:bg-orange-600 transition duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    {{ __('اطلب الآن') }}
                                </a>
                            @else
                                <div class="text-center py-3 bg-gray-100 rounded-md text-gray-500">
                                    {{ __('بيانات الطبق غير مكتملة') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('لا توجد أطباق متاحة') }}</h3>
                    <p class="mt-1 text-gray-500">{{ __('لم يتم العثور على أطباق تطابق معايير البحث') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('client.dishes.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600">
                            {{ __('عرض جميع الأطباق') }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- الترقيم الصفحات -->
        @if($dishes->hasPages())
            <div class="mt-8">
                {{ $dishes->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    // بيانات المدن حسب البلد محملة من السيرفر
    const citiesData = @json($countries);
    function updateCities() {
        const countrySelect = document.getElementById('country-select');
        const citySelect = document.getElementById('city-select');
        const countryId = countrySelect.value;
        // مسح الخيارات الحالية
        citySelect.innerHTML = '<option value="">{{ __('كل المدن') }}</option>';
        if (countryId && citiesData[countryId] && citiesData[countryId].cities) {
            citiesData[countryId].cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.text = city.name;
                citySelect.appendChild(option);
            });
        }
    }
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.favorite-button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const dishId = this.dataset.dishId;
                axios.post("{{ route('client.favorites.toggle') }}", {
                    dish_id: dishId
                }, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    const status = response.data.status;
                    if (status === 'added') {
                        this.style.color = '#ef4444'; // red-500
                    } else if (status === 'removed') {
                        this.style.color = '#d1d5db'; // gray-300
                    }
                })
                .catch(error => {
                    console.error('حدث خطأ:', error);
                    alert('{{ __('حدث خطأ أثناء حفظ الطبق في المفضلة') }}');
                });
            });
        });
    });
</script>
@endpush