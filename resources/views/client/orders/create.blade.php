@extends('layouts.client')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('طلب أكلة من') }} {{ $cook->name }}</h2>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <ul class="mb-0 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-red-700">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.orders.store') }}" class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
        @csrf
        <input type="hidden" name="cook_id" value="{{ $cook->id }}">
        <input type="hidden" name="dish_id" value="{{ $dish->id }}">

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">{{ __('الكمية') }}</label>
            <input type="number" name="quantity" id="quantity" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500" min="1" value="1" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">{{ __('العنوان') }}</label>
            <textarea name="address" id="address" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500" required></textarea>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                {{ __('إرسال الطلب') }}
            </button>
        </div>
    </form>
</div>
@endsection