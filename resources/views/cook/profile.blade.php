@extends('layouts.chef')
@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- رأس الصفحة -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ __('الملف الشخصي') }}</h1>
                <p class="mt-2 text-gray-600">{{ __('قم بتحديث معلوماتك الشخصية والمهنية') }}</p>
            </div>
            <a href="{{ route('cook.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 transition duration-150">
                {{ __('العودة للوحة التحكم') }}
            </a>
        </div>

        <!-- رسالة النجاح -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg animate-fade-in">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- بطاقة النموذج -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <form method="POST" action="{{ route('cook.profile.update') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                <!-- قسم المعلومات الأساسية -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">{{ __('المعلومات الأساسية') }}</h2>
                    
                    <!-- الاسم الكامل -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('الاسم الكامل') }} *</label>
                        <input type="text" name="full_name" value="{{ old('full_name', $cook->full_name ?? '') }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('البريد الإلكتروني') }} *</label>
                        <input type="email" name="email" value="{{ old('email', $cook->email ?? '') }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- قسم الموقع الجغرافي -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">{{ __('الموقع الجغرافي') }}</h2>
                    <div class="mb-4">
                        <label for="country-select">{{ __('البلد') }}:</label>
                        <select name="country_id" id="country-select" onchange="updateCities()" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                            <option value="">{{ __('اختر البلد') }}</option>
                            @foreach(\App\Models\Country::all() as $country)
                                <option value="{{ $country->id }}" {{ $cook->country_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="city-select">{{ __('المدينة') }}:</label>
                        <select name="city_id" id="city-select" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                            <option value="">{{ __('اختر المدينة') }}</option>
                            @if($cook->country_id)
                                @foreach(\App\Models\City::where('country_id', $cook->country_id)->get() as $city)
                                    <option value="{{ $city->id }}" {{ $cook->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <script>
                    // بيانات المدن محملة من لارافيل
                    const citiesData = @json(\App\Models\Country::with('cities')->get()->keyBy('id'));
                    function updateCities() {
                        const countryId = document.getElementById('country-select').value;
                        const citySelect = document.getElementById('city-select');
                        citySelect.innerHTML = '<option value="">{{ __('اختر المدينة') }}</option>';
                        if (countryId && citiesData[countryId] && citiesData[countryId].cities) {
                            citiesData[countryId].cities.forEach(city => {
                                citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                            });
                        }
                    }
                </script>

                <!-- قسم التخصصات -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">{{ __('التخصصات') }}</h2>
                    <!-- أنواع الأكل -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('أنواع الأكل التي تجيدها') }} *</label>
                        <select name="categories[]" multiple class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $cookCategories ?? [])) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">{{ __('اضغط على Ctrl (أو Cmd في الماك) لاختيار أكثر من نوع') }}</p>
                        @error('categories')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- قسم الصورة الشخصية -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">{{ __('الصورة الشخصية') }}</h2>
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- معاينة الصورة -->
                        <div class="flex-shrink-0">
                            @if($cook->photo)
                                <img src="{{ asset('storage/' . $cook->photo) }}" alt="{{ __('الصورة الشخصية') }}" class="h-32 w-32 rounded-full object-cover shadow-md border-2 border-white">
                            @else
                                <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <!-- تحميل الصورة -->
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('تغيير الصورة') }}</label>
                            <div class="mt-1 flex items-center">
                                <label for="avatar" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150">
                                    {{ __('اختر صورة') }}
                                    <input id="avatar" name="avatar" type="file" class="sr-only">
                                </label>
                                <span class="ml-3 text-sm text-gray-500" id="file-name">
                                    @if($cook->avatar)
                                        {{ basename($cook->avatar) }}
                                    @else
                                        {{ __('لا توجد صورة') }}
                                    @endif
                                </span>
                            </div>
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- زر الحفظ -->
                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-full shadow-sm text-base font-medium text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200">
                        {{ __('حفظ التغييرات') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // عرض اسم الملف عند اختياره
    document.getElementById('avatar').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "{{ __('لا توجد صورة') }}";
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endpush

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    select[multiple] {
        background-image: none;
        height: auto;
        min-height: 42px;
    }
</style>
@endsection