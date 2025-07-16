<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'منصة الطهاة') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #F59E0B;
            --secondary-color: #F97316;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #fff7ed, #fef3c7);
        }
        
        /* Animation for the auth card */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-card {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-amber-50 to-amber-100">

    <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4">
        <!-- Logo and App Name -->
        <div class="text-center mb-10 flex flex-col items-center">
            <a href="/" class="inline-block transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/logo.png') }}" alt="" class="w-32 sm:w-40 h-auto drop-shadow-lg">
            </a>
            <h1 class="mt-4 text-3xl font-bold text-amber-800 tracking-tight">
                
                {{ __('By Home') }}
            </h1>
            <p class="mt-2 text-amber-600 max-w-md">
                
                {{ __('منصة متخصصة للطهاة المحترفين و عشاق الطبخ') }}
            </p>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md bg-white border border-amber-200 shadow-xl rounded-3xl overflow-hidden auth-card">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 py-4 px-6">
                <h2 class="text-xl font-bold text-white text-center">
                    {{ isset($title) ? $title : __('مرحباً بعودتك') }}
                </h2>
            </div>
            
            <!-- Card Content -->
            <div class="px-6 py-8 sm:p-10 transition-all duration-300">
                {{ $slot }}
            </div>
            
            <!-- Card Footer -->
            <div class="bg-amber-50 px-6 py-4 border-t border-amber-100 text-center">
                @if (Route::has('register'))
                    <p class="text-amber-700 text-sm">
                    {{ __('ليس لديك حساب؟') }}
                        <a href="{{ route('register') }}" class="font-medium text-amber-600 hover:text-amber-800 hover:underline">
                           
                            {{ __('سجل الآن') }}
                        </a>
                    </p>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-center text-sm text-amber-700">
            &copy; {{ date('Y') }} {{ config('منصة الطهاة') }}. {{ __('جميع الحقوق محفوظة.') }}
        </div>
    </div>

</body>
</html>