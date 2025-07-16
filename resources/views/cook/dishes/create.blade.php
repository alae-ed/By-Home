@extends('layouts.chef')
@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-right">{{ __('إضافة وجبة جديدة') }}</h1>

            <form method="POST" action="{{ route('cook.dishes.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- رسائل الخطأ -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc mr-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- رسالة النجاح -->
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- اسم الوجبة -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 text-right">{{ __('اسم الوجبة') }}</label>
                    <input type="text" name="name" id="name" 
                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           required placeholder="{{ __('مثال: كبسة الدجاج') }}">
                </div>

                <!-- الوصف -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 text-right">{{ __('الوصف') }}</label>
                    <textarea name="description" id="description" rows="4"
                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                              placeholder="{{ __('وصف مفصل عن الوجبة والمكونات') }}"></textarea>
                </div>

                <!-- السعر -->
                <div class="space-y-2">
                    <label for="price" class="block text-sm font-medium text-gray-700 text-right">{{ __('السعر') }} ({{ __('درهم') }})</label>
                    <div class="relative">
                        <input type="number" name="price" id="price" step="0.01" min="0"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               required placeholder="{{ __('مثال: 25.00') }}">
                        <div class="absolute left-3 top-3 text-gray-500">{{ __('درهم') }}</div>
                    </div>
                </div>

                <!-- نوع الطبخ من قاعدة البيانات -->
                <div class="space-y-2">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 text-right">{{ __('نوع الأكل') }}</label>
                    <select name="category_id" id="category_id"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="" disabled selected>{{ __('اختر نوع الأكل') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- صورة الوجبة -->
                <div class="space-y-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 text-right">{{ __('صورة الوجبة') }}</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">{{ __('انقر لرفع الصورة') }}</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG ({{ __('الحجم الأقصى: 2MB') }})</p>
                            </div>
                            <input id="image" name="image" type="file" class="hidden" required accept="image/*">
                        </label>
                    </div> 
                </div>

                <!-- معاينة الصورة -->
                <div id="imagePreviewContainer" class="hidden">
                    <img id="imagePreview" class="max-w-xs rounded-lg border border-gray-200">
                </div>

                <!-- زر الإرسال -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                        {{ __('إضافة الوجبة') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // عرض معاينة الصورة عند اختيارها
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('imagePreviewContainer');
                    const previewImage = document.getElementById('imagePreview');
                    
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection