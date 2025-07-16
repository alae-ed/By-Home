<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('منصة ChefZone للطلب من طهاة المنزل - تجربة طهي فريدة في منزلك') }}">
    <title>@yield('title', 'ChefZone') | {{ __('زبائن') }}</title>

    <!-- Preload important resources -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        client: {
                            primary: '#FF6B6B',
                            dark: '#2D3142',
                            light: '#F1F1F1',
                            secondary: '#4ECDC4',
                            accent: '#FFE66D'
                        }
                    },
                    fontFamily: {
                        sans: ['Tajawal', 'sans-serif']
                    },
                    transitionProperty: {
                        'height': 'height',
                        'width': 'width'
                    }
                }
            },
            plugins: [
                require('@tailwindcss/forms'),
                require('@tailwindcss/typography'),
                require('tailwindcss-rtl')
            ]
        }
    </script>

    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');
        
        body {
            scroll-behavior: smooth;
        }
        
        .dropdown-menu {
            transition: all 0.3s ease-in-out;
            opacity: 0;
            transform: translateY(-10px);
            visibility: hidden;
        }
        
        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
        
        .profile-initial {
            transition: all 0.3s ease;
        }
        
        .profile-initial:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            position: relative;
            padding-bottom: 4px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background-color: #FF6B6B;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
            left: 0;
        }
        
        @media (max-width: 768px) {
            .mobile-menu {
                transition: all 0.3s ease-in-out;
                max-height: 0;
                overflow: hidden;
            }
            
            .mobile-menu.open {
                max-height: 500px;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

<!-- Header Section -->
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo & Mobile Menu Button -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <button id="mobile-menu-button" class="md:hidden text-client-dark focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <a href="{{ route('client.dishes.index') }}" class="flex items-center group">
                    <i class="fas fa-utensils text-client-primary text-2xl ml-2 transition duration-300 group-hover:rotate-12"></i>
                    <span class="text-xl font-bold text-client-dark group-hover:text-client-primary transition">ChefZone</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8 space-x-reverse items-center">
                <a href="{{ route('client.dishes.index') }}" class="nav-link text-client-dark hover:text-client-primary flex items-center">
                    <i class="fas fa-utensils ml-2"></i> {{ __('الأطباق') }}
                </a>
                <a href="{{ route('client.dashboard') }}" class="nav-link text-client-dark hover:text-client-primary flex items-center">
                    <i class="fas fa-tachometer-alt ml-2"></i> {{ __('لوحة التحكم') }}
                </a>
                <a href="{{ route('client.favorites.index') }}" class="nav-link text-client-dark hover:text-client-primary flex items-center">
                    <i class="fas fa-heart ml-2"></i> {{ __('مفضلتي') }}
                </a>
                <a href="{{ route('client.orders.index') }}" class="nav-link text-client-dark hover:text-client-primary flex items-center">
                    <i class="fas fa-clipboard-list ml-2"></i> {{ __('طلباتي') }}
                </a>
            </nav>

            <!-- Profile Dropdown -->
            <div class="relative dropdown flex items-center">
                <button class="flex items-center gap-2 focus:outline-none group">
                    <div class="profile-initial w-10 h-10 bg-gradient-to-br from-client-primary to-client-secondary text-white rounded-full flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:block text-client-dark group-hover:text-client-primary transition">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-sm text-client-dark group-hover:text-client-primary transition"></i>
                </button>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl w-48 z-50 py-1">
                    <a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-client-primary transition flex items-center">
                        <i class="fas fa-user-circle ml-2"></i> {{ __('الملف الشخصي') }}
                    </a>
                    <a href="{{ route('client.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-client-primary transition flex items-center">
                        <i class="fas fa-tachometer-alt ml-2"></i> {{ __('لوحة التحكم') }}
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-client-primary transition flex items-center">
                        <i class="fas fa-cog ml-2"></i> {{ __('الإعدادات') }}
                    </a>
                    <div class="border-t border-gray-200 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-right px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-client-primary transition flex items-center justify-end">
                            <i class="fas fa-sign-out-alt ml-2"></i> {{ __('تسجيل الخروج') }}
                        </button>
                    </form>
                    </div>  
                </div>  
        </div>

        
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="mobile-menu md:hidden bg-white mt-2">
            <div class="flex flex-col space-y-2 py-2">
                <a href="{{ route('client.dishes.index') }}" class="px-3 py-2 hover:bg-gray-100 rounded flex items-center">
                    <i class="fas fa-utensils ml-2"></i> {{ __('الأطباق') }}
                </a>
                <a href="{{ route('client.dashboard') }}" class="px-3 py-2 hover:bg-gray-100 rounded flex items-center">
                    <i class="fas fa-tachometer-alt ml-2"></i> {{ __('لوحة التحكم') }}
                </a>
                <a href="{{ route('client.favorites.index') }}" class="px-3 py-2 hover:bg-gray-100 rounded flex items-center">
                    <i class="fas fa-heart ml-2"></i> {{ __('مفضلتي') }}
                </a>
                <a href="{{ route('client.orders.index') }}" class="px-3 py-2 hover:bg-gray-100 rounded flex items-center">
                    <i class="fas fa-clipboard-list ml-2"></i> {{ __('طلباتي') }}
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<main class="container mx-auto px-4 py-6 min-h-screen">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 space-x-reverse md:space-x-3 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                
            </li>
            @yield('breadcrumbs')
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-client-dark flex items-center">
                @yield('icon', '')
                @yield('title')
            </h1>
            <p class="text-gray-600 mt-2">@yield('subtitle')</p>
        </div>
        <div class="mt-4 md:mt-0">
            @yield('actions')
        </div>
    </div>

    <!-- Content -->
    @yield('content')
</main>

<!-- Footer Section -->
<footer class="bg-gradient-to-b from-[#1F1F1F] to-[#0F0F0F] text-white py-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- About -->
            <div class="text-center md:text-right">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-center md:justify-end">
                    <i class="fas fa-utensils ml-2 text-client-primary"></i>
                    ChefZone
                </h3>
                <p class="text-gray-400 leading-relaxed">
                    {{ __('منصة متخصصة لتوصيل أطباق طهاة المنزل إلى عملائهم بجودة عالية وطعم منزلي أصيل.') }}
                </p>
                <div class="mt-4 flex justify-center md:justify-end">
                    <img src="/images/payment-methods.png" alt="Payment Methods" class="h-8">
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-center md:text-right">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-center md:justify-end">
                    <i class="fas fa-link ml-2 text-client-primary"></i>
                    {{ __('روابط سريعة') }}
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('client.dishes.index') }}" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-utensils ml-2"></i> {{ __('الأطباق') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.dashboard') }}" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-tachometer-alt ml-2"></i> {{ __('لوحة التحكم') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.favorites.index') }}" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-heart ml-2"></i> {{ __('مفضلتي') }}
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-envelope ml-2"></i> {{ __('اتصل بنا') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="text-center md:text-right">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-center md:justify-end">
                    <i class="fas fa-headset ml-2 text-client-primary"></i>
                    {{ __('خدمة العملاء') }}
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-question-circle ml-2"></i> {{ __('الأسئلة الشائعة') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-shield-alt ml-2"></i> {{ __('سياسة الخصوصية') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-file-contract ml-2"></i> {{ __('الشروط والأحكام') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-client-primary transition flex items-center justify-center md:justify-end">
                            <i class="fas fa-truck ml-2"></i> {{ __('سياسة التوصيل') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="text-center md:text-right">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-center md:justify-end">
                    <i class="fas fa-envelope ml-2 text-client-primary"></i>
                    {{ __('تواصل معنا') }}
                </h3>
                <div class="flex justify-center md:justify-end gap-3">
                    @foreach([
                        ['icon' => 'facebook-f', 'color' => 'bg-blue-600'],
                        ['icon' => 'instagram', 'color' => 'bg-pink-600'],
                        ['icon' => 'twitter', 'color' => 'bg-blue-400'],
                        ['icon' => 'whatsapp', 'color' => 'bg-green-500'],
                        ['icon' => 'youtube', 'color' => 'bg-red-600']
                    ] as $social)
                        <a href="#" class="w-10 h-10 {{ $social['color'] }} hover:bg-client-primary transition rounded-full flex items-center justify-center text-white">
                            <i class="fab fa-{{ $social['icon'] }}"></i>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4 text-gray-400 text-sm space-y-2">
                    <p class="flex items-center justify-center md:justify-end">
                        <i class="fas fa-phone-alt ml-2 text-client-primary"></i>+123 456 7890
                    </p>
                    <p class="flex items-center justify-center md:justify-end">
                        <i class="fas fa-envelope ml-2 text-client-primary"></i>info@chefzone.com
                    </p>
                    <p class="flex items-center justify-center md:justify-end">
                        <i class="fas fa-map-marker-alt ml-2 text-client-primary"></i>الرياض، المملكة العربية السعودية
                    </p>
                </div>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="mt-12 border-t border-gray-700 pt-8">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-center">
                    <i class="fas fa-envelope-open-text ml-2 text-client-primary"></i>
                    {{ __('اشترك في نشرتنا البريدية') }}
                </h3>
                <p class="text-gray-400 mb-6">{{ __('احصل على آخر العروض والتخفيضات مباشرة إلى بريدك الإلكتروني') }}</p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="بريدك الإلكتروني" class="flex-grow px-4 py-2 rounded-full bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-client-primary">
                    <button type="submit" class="px-6 py-2 bg-client-primary hover:bg-client-dark rounded-full font-medium transition">
                        {{ __('اشتراك') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-500 text-sm">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    {{ __('جميع الحقوق محفوظة') }} &copy; ChefZone {{ date('Y') }}
                </div>
                <div class="flex items-center justify-center space-x-4 space-x-reverse">
                    <img src="/images/app-store.png" alt="App Store" class="h-8">
                    <img src="/images/google-play.png" alt="Google Play" class="h-8">
                </div>
            </div>
            <div class="mt-4">
                {{ __('تم التطوير بحب') }} <i class="fas fa-heart text-client-primary"></i>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Action Button -->
<div class="fixed bottom-6 left-6 z-50">
    <div class="flex flex-col space-y-3">
        <a href="#" class="w-14 h-14 bg-client-primary rounded-full shadow-lg flex items-center justify-center text-white relative hover:bg-client-dark transition">
            <i class="fas fa-shopping-cart text-xl"></i>
            <span class="absolute -top-1 -right-1 bg-client-secondary text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">3</span>
        </a>
        
        <a href="https://wa.me/1234567890" class="w-14 h-14 bg-green-500 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-green-600 transition">
            <i class="fab fa-whatsapp text-xl"></i>
        </a>
    </div>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-6 right-6 w-12 h-12 bg-client-dark text-white rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50 hover:bg-client-primary">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Scripts -->
<script>
    // Enhanced dropdown functionality
    document.addEventListener('DOMContentLoaded', function () {
        // Profile dropdown
        const profileBtn = document.querySelector('.dropdown > button');
        const profileMenu = document.querySelector('.dropdown-menu');
        
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('show');
        });
        
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.remove('show');
            }
            
            if (!mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    mobileMenu.classList.remove('open');
                }
            });
        });
        
        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

    
</script>



@stack('scripts')
</body>
</html>