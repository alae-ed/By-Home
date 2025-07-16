@extends('layouts.app')

@section('content')



<!-- Hero Section - تصميم حديث مع تأثيرات حركية -->
<section class="relative min-h-screen flex items-center justify-center bg-black overflow-hidden">
    <!-- سلايدر صور الخلفية -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full slideshow">
            <div class="slide bg-cover bg-center" style="background-image: url('{{ asset('images/bg1.png') }}');"></div>
            <div class="slide bg-cover bg-center" style="background-image: url('{{ asset('images/bg2.png') }}');"></div>
            <div class="slide bg-cover bg-center" style="background-image: url('{{ asset('images/bg3.png') }}');"></div>
        </div>
    </div>

    <!-- محتوى الهيرو -->
    <div class="relative z-10 text-center px-6 max-w-6xl mx-auto">
        <div class="mb-8 animate-fade-in">
            <span class="inline-block bg-white/10 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-sm font-medium mb-4 border border-white/20">
                {{ __('تجربة طعام فاخرة') }}
            </span>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            <span class="block">{{ __('اكتشف أطباقًا') }}</span>
            <span class="block bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-orange-400">{{ __('منزلية مميزة') }}</span>
        </h1>

        <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed">
            {{ __('نوصل لك أشهى الأطباق المنزلية المعدة بأيدي أمهر الطهاة في مدينتك، بلمسة حرفية وجودة عالية') }}
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" class="relative overflow-hidden group bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 text-white font-bold py-4 px-8 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <span class="relative z-10">{{ __('سجل كطاهٍ محترف') }}</span>
                <span class="absolute inset-0 bg-gradient-to-r from-orange-600 to-yellow-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
            <a href="{{ route('register') }}" class="relative overflow-hidden group bg-white/10 hover:bg-white/20 text-white font-bold py-4 px-8 rounded-full border border-white/20 backdrop-blur-md shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <span class="relative z-10">{{ __('اطلب الآن') }}</span>
                <span class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            </a>
        </div>
    </div>

    <!-- تأثير إضافي سفلي -->
    <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-gray-50 to-transparent"></div>
</section>

<!-- CSS سلايدر الصور -->
<style>
.slideshow {
    position: relative;
    width: 100%;
    height: 100%;
}
.slide {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    animation: slideAnimation 18s infinite;
    transition: opacity 2s ease-in-out;
    background-size: cover;
    background-position: center;
}
.slide:nth-child(1) {
    animation-delay: 0s;
}
.slide:nth-child(2) {
    animation-delay: 6s;
}
.slide:nth-child(3) {
    animation-delay: 12s;
}

@keyframes slideAnimation {
    0% { opacity: 0; }
    8% { opacity: 1; }
    30% { opacity: 1; }
    38% { opacity: 0; }
    100% { opacity: 0; }
}
</style>




<!-- Search Section - تصميم متناسق بدون صور خلفية -->
<!-- Search Section - تحسين ألوان النص فقط -->
<section class="relative bg-gradient-to-b from-gray-900 to-gray-800 py-16 overflow-hidden">
    <!-- تأثيرات بصرية خفيفة -->
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-400/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-gradient-to-t from-orange-400/10 to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-5xl mx-auto bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-lg border border-white/10 hover:border-orange-400/30 transition-all duration-500 hover:shadow-xl -translate-y-20">
            <div class="text-center mb-6">
                <span class="inline-block bg-orange-400/10 text-orange-300/90 px-4 py-1 rounded-full text-sm font-medium mb-3 border border-orange-400/30">
                    {{ __('استكشف المطاعم') }}
                </span>
                <h2 class="text-3xl font-bold text-orange-500 mb-2">{{ __('ابحث عن الأطباق المفضلة') }}</h2>
                <p class="text-gray-300/90 max-w-lg mx-auto">{{ __('اكتشف تشكيلة واسعة من الأطباق المنزلية المميزة في مدينتك') }}</p>
            </div>
            
            <form method="GET" action="{{ route('search.dishes') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-orange-300/80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <input type="text" name="city" class="w-full py-3 px-4 pr-12 rounded-xl bg-white/5 border border-white/10 text-gray-100 placeholder-gray-400/70 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all" placeholder="{{ __('أدخل اسم المدينة') }}">
                </div>
                
                <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 text-gray-50 font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ __('بحث') }}</span>
                </button>
            </form>
        </div>
    </div>
</section>
<!-- Special Offers Section - تصميم عصري بدون خلفية -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <!-- Header with improved design -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <div class="text-center md:text-right mb-4 md:mb-0">
                <span class="inline-block bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm font-medium mb-2">
                    {{ __('عروض حصرية') }}
                </span>
                <h2 class="text-3xl font-bold text-gray-800">{{ __('اكتشف عروضنا المميزة') }}</h2>
            </div>
            <a href="{{ route('search.dishes') }}" class="flex items-center text-orange-600 hover:text-orange-700 font-medium transition-colors duration-300">
                {{ __('تصفح جميع العروض') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 transform transition-transform hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <!-- Dishes Grid with enhanced card design -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($specialOffers as $dish)
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-orange-200 relative">
                <!-- Ribbon Badge -->
                <div class="absolute top-3 right-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                    {{ __('خصم').$dish->discount_percentage.'%' }}
                </div>
                
                <!-- Dish Image -->
                <div class="relative h-48 overflow-hidden">
                    
                    <img src="{{ asset('storage/' . $dish->image) }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                         alt="{{ $dish->name }}" 
                         loading="lazy">
                    

                </div>
                
                <!-- Dish Content -->
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $dish->name }}</h3>
                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded">{{ $dish->category->name ?? __('عام') }}</span>
                    </div>
                    
                    <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $dish->description ?? 'طبق مميز من إعداد طاهينا المحترف' }}</p>
                    
                    <!-- Price & Add to Cart -->
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-orange-600 font-bold">{{ $dish->price }} {{ __('درهم') }}</span>
                            @if($dish->original_price)
                            <span class="text-gray-400 text-sm line-through mr-2">{{ $dish->original_price }} {{ __('درهم') }}</span>
                            @endif
                        </div>
                        <button class="w-9 h-9 flex items-center justify-center bg-orange-100 hover:bg-orange-200 text-orange-600 rounded-full transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Top Chefs Section - تصميم عصري للطهاة -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">{{ __('أفضل الطهاة لدينا') }}</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ __('تعرف على طهاةنا المميزين الذين يعدون أشهى الأطباق بخبرة واحترافية') }}</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($topCooks as $index => $cook)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 text-center p-6 border border-gray-100 group">
                <div class="relative inline-block mb-5">
                    <div class="relative overflow-hidden rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto border-4 border-orange-100 shadow-md group-hover:border-orange-200 transition-all duration-300">
                        <img src="{{ asset('storage/' . $cook->photo) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $cook->full_name }}" loading="lazy">
                    </div>
                    <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full border-2 border-white shadow-sm"></div>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $cook->full_name }}</h3>
                <p class="text-gray-600 mb-3 text-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $cook->city?->name ?? 'غير محدد' }}
                </p>
                
                <div class="flex justify-center space-x-1 mb-5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 {{ $i < ($cook->rating ?? 5) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                
                <div class="flex justify-center gap-3">
                    <a href="#" class="flex-1 bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 text-white font-medium py-2 px-4 rounded-full text-sm shadow-md hover:shadow-lg transition-all duration-300">
                        {{ __('الملف الشخصي') }}
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full shadow-sm transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Most Popular Section - تصميم مميز مع ترتيب -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ __('الأكثر طلباً') }}</h2>
                <p class="text-gray-600">{{ __('الأطباق الأكثر شعبية بين عملائنا هذا الأسبوع') }}</p>
            </div>
            <a href="{{ route('search.dishes') }}" class="inline-flex items-center text-orange-500 hover:text-orange-600 font-medium group transition-colors duration-300 mt-4 md:mt-0">
                {{ __('عرض الكل') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 transform group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($popularDishes as $index => $dish)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 relative">
                <!-- Rank Badge -->
                <div class="absolute top-4 left-4 flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 text-white font-bold shadow-md z-10">
                    #{{ $index + 1 }}
                </div>
                
                <!-- Image -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('storage/' . $dish->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $dish->name }}" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                </div>
                
                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $dish->name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ $dish->description }}</p>
                    
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-orange-500 font-bold text-xl">{{ $dish->price }} {{ __('درهم') }}</span>
                        <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            {{ $dish->orders_count ?? rand(15, 50) }} {{ __('طلب') }}
                        </span>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 text-white font-medium py-3 rounded-full text-sm shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        {{ __('أضف إلى السلة') }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action Section - تصميم جذاب -->
<section class="py-20 bg-gradient-to-br from-orange-500 to-amber-500 text-white relative overflow-hidden">
    <!-- تأثيرات خلفية -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==')]"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 leading-tight">
                {{ __('هل لديك موهبة في الطبخ؟') }}<br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-amber-100">{{ __('انضم إلى طهاة طبق اليوم') }}</span>
            </h2>
            
            <p class="text-lg md:text-xl mb-8 leading-relaxed opacity-90">
                {{ __('سجل كطاهٍ محترف وابدأ بيع أطباقك المميزة لعملائنا، مع دعم كامل ومرونة في العمل') }}
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="relative overflow-hidden group bg-white text-orange-600 hover:text-orange-700 font-bold py-4 px-8 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <span class="relative z-10">{{ __('سجل الآن') }}</span>
                    <span class="absolute inset-0 bg-white/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
                <a href="#" class="relative overflow-hidden group bg-transparent border-2 border-white/30 hover:border-white/50 text-white font-bold py-4 px-8 rounded-full backdrop-blur-md shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <span class="relative z-10">{{ __('المزيد من التفاصيل') }}</span>
                    <span class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- تأثيرات إضافية -->
    <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent"></div>
</section>

@endsection