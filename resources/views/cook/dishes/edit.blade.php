@extends('layouts.chef')
@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">{{ __('تعديل الوجبة') }}</h1>

    <form action="{{ route('cook.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('اسم الوجبة') }}</label>
            <input type="text" name="name" value="{{ old('name', $dish->name) }}" class="w-full border rounded px-3 py-2" required>
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('الوصف') }}</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $dish->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('الثمن') }} ({{ __('درهم') }})</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $dish->price) }}" class="w-full border rounded px-3 py-2" required>
            @error('price')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('نوع الطبخ') }}</label>
            <input type="text" name="cuisine_type" value="{{ old('cuisine_type', $dish->cuisine_type) }}" class="w-full border rounded px-3 py-2" required>
            @error('cuisine_type')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('الصورة الحالية') }}</label>
            @if($dish->image)
                <img src="{{ asset('storage/' . $dish->image) }}" class="w-40 h-40 object-cover rounded mb-2" alt="{{ __('الصورة الحالية') }}">
            @else
                <p class="text-gray-500">{{ __('لا توجد صورة') }}</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('تغيير الصورة') }}</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ __('حفظ التعديلات') }}
        </button>
    </form>
</div>
@endsection