<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'تسجيل حساب - منصة الطهاة')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-orange-50 to-yellow-100 font-sans text-right">

    {{-- ✅ Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-orange-600 flex items-center space-x-2 space-x-reverse">
                <span>🧑‍🍳 منصة الطهاة</span>
            </a>
            <div class="flex items-center space-x-4 space-x-reverse text-sm">
                <a href="/" class="text-gray-700 hover:text-orange-600 transition">الرئيسية</a>
                <a href="/login" class="text-gray-700 hover:text-orange-600 transition">تسجيل الدخول</a>
                <a href="/register" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">انضم الآن</a>
            </div>
        </div>
    </nav>

    {{-- ✅ محتوى الصفحة --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- ✅ Footer --}}
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4 flex items-center space-x-2 space-x-reverse">
                    <span>🫕</span><span>منصة الطهاة</span>
                </h3>
                <p class="text-sm text-gray-300">
                    منصة تربط بين الطهاة المنزليين وعشاق الطعام في مدنهم، اكتشف نكهات أصلية من مطبخ بلدك!
                </p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">روابط سريعة</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="/" class="hover:text-white">الرئيسية</a></li>
                    <li><a href="/register" class="hover:text-white">التسجيل</a></li>
                    <li><a href="/login" class="hover:text-white">تسجيل الدخول</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">تابعنا</h4>
                <div class="flex space-x-4 space-x-reverse text-sm">
                    <a href="#" class="hover:text-white">📘 فيسبوك</a>
                    <a href="#" class="hover:text-white">📸 إنستغرام</a>
                    <a href="#" class="hover:text-white">🐦 تويتر</a>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 text-center py-4 text-sm text-gray-400">
            &copy; {{ date('Y') }} منصة الطهاة. جميع الحقوق محفوظة.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
