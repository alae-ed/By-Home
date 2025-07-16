@extends('layouts.chef')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ __('قائمة الوجبات') }}</h1>
        
        <a href="{{ route('cook.dishes.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            {{ __('إضافة وجبة جديدة') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if($dishes->isEmpty())
        <div class="bg-white p-8 rounded-lg shadow-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h3 class="text-xl font-medium text-gray-700 mb-2">{{ __('لا توجد وجبات مضافة بعد') }}</h3>
            <p class="text-gray-500 mb-4">{{ __('يمكنك البدء بإضافة وجباتك الأولى الآن') }}</p>
            <a href="{{ route('cook.dishes.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-300">
                {{ __('إضافة وجبة جديدة') }}
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($dishes as $dish)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full">
                    <!-- صورة الوجبة -->
                    <div class="relative pt-[56.25%] overflow-hidden">
                        @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" 
                                class="absolute inset-0 w-full h-full object-cover"
                                alt="{{ $dish->name }}">
                        @else
                            <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- محتوى البطاقة -->
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $dish->name }}</h2>
                            <span class="bg-amber-100 text-amber-800 text-sm font-medium px-2 py-1 rounded-full whitespace-nowrap">
                                {{ $dish->price }} {{ __('درهم') }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 mb-4 flex-grow">{{ Str::limit($dish->description, 80) }}</p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                            </svg>
                            {{ $dish->cuisine_type }}
                        </div>
                        
                        <div class="border-t border-gray-100 pt-3 flex justify-end space-x-3">
                            <a href="{{ route('cook.dishes.edit', $dish->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('تعديل') }}
                            </a>
                            
                            <form action="{{ route('cook.dishes.destroy', $dish->id) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه الوجبة؟') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    {{ __('حذف') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection