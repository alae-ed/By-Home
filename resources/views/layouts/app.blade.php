<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('منصة الطهاة'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans min-h-screen flex flex-col">

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <a href="/" class="text-2xl font-bold text-gray-800">🍽 {{ __('By Home') }}</a>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="/" class="text-gray-600 hover:text-gray-900">{{ __('الرئيسية') }}</a>
            <a href="/register" class="text-gray-600 hover:text-gray-900">{{ __('انضم الآن') }}</a>
            <a href="/login" class="text-gray-600 hover:text-gray-900">{{ __('تسجيل الدخول') }}</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-16">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-lg font-semibold mb-4">{{ __('By Home') }}</h3>
            <p class="text-sm text-gray-300">
                {{ __('منصة تجمع بين عشاق الأكل والطهاة المهرة. اكتشف أكلات منزلية أصلية من مدينتك!') }}
            </p>
        </div>
        <div>
            <h4 class="font-semibold mb-4">{{ __('روابط سريعة') }}</h4>
            <ul class="space-y-2 text-sm text-gray-300">
                <li><a href="/" class="hover:text-white">{{ __('الرئيسية') }}</a></li>
                <li><a href="/register" class="hover:text-white">{{ __('التسجيل') }}</a></li>
                <li><a href="/login" class="hover:text-white">{{ __('تسجيل الدخول') }}</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold mb-4">{{ __('تابعنا') }}</h4>
            <div class="flex space-x-4 space-x-reverse">
                <a href="#" class="hover:text-white">🌐 {{ __('فيسبوك') }}</a>
                <a href="#" class="hover:text-white">📷 {{ __('إنستغرام') }}</a>
                <a href="#" class="hover:text-white">🐦 {{ __('تويتر') }}</a>
            </div>
        </div>
    </div>
    <div class="bg-gray-900 text-center py-4 text-sm text-gray-400">
        &copy; {{ date('Y') }} {{ __('By Home') }}. {{ __('جميع الحقوق محفوظة.') }}
    </div>
</footer>

@stack('scripts')
</body>
</html>