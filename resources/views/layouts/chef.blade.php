<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ __('Chef Dashboard') }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        chef: {
                            primary: '#FF6B6B',
                            secondary: '#4ECDC4',
                            dark: '#292F36',
                            light: '#F7FFF7'
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .nav-link {
            position: relative;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            {{ app()->getLocale() == 'ar' ? 'right: 0;' : 'left: 0;' }}
            background-color: #FF6B6B;
            transition: width 0.3s ease;
        }
        .nav-link:hover:after {
            width: 100%;
        }
        [dir="rtl"] .rotate-on-rtl {
            transform: rotate(180deg);
        }
        #language-menu {
            transition: opacity 0.2s ease, transform 0.2s ease;
            opacity: 0;
            transform: translateY(-5px);
        }
        #language-menu:not(.hidden) {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/cook/dashboard" class="flex items-center">
                        <i class="fas fa-utensils text-chef-primary text-2xl {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        <span class="text-chef-dark text-xl font-bold">{{ __('ChefZone') }}</span>
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link text-chef-dark hover:text-chef-primary">
                        <i class="fas fa-tachometer-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('اللوحة الرئيسية') }}
                    </a>
                    <a href="{{ route('cook.dishes.index') }}" class="nav-link text-chef-dark hover:text-chef-primary">
                        <i class="fas fa-hamburger {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('وجباتي') }}
                    </a>
                    <a href="{{ route('cook.orders.index') }}" class="nav-link text-chef-dark hover:text-chef-primary">
                        <i class="fas fa-receipt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('الطلبات') }}
                    </a>
                    <a href="/cook/profile" class="nav-link text-chef-dark hover:text-chef-primary">
                        <i class="fas fa-user {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('الملف الشخصي') }}
                    </a>
                </nav>

                <!-- User Dropdown and Language Selector -->
                <div class="flex items-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <!-- Language Switcher -->
                    <div class="relative">
                        <button id="language-switcher" class="flex items-center text-chef-dark hover:text-chef-primary focus:outline-none">
                            <span class="hidden md:inline">{{ app()->getLocale() == 'ar' ? 'العربية' : 'Français' }}</span>
                            <i class="fas fa-globe {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}"></i>
                            <i class="fas fa-chevron-down text-xs {{ app()->getLocale() == 'ar' ? 'mr-1' : 'ml-1' }} rotate-on-rtl"></i>
                        </button>
                        
                        <div id="language-menu" class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-28 bg-white rounded-md shadow-lg py-1 hidden z-50 border border-gray-100">
                            <form action="{{ route('language.switch') }}" method="POST">
                                @csrf
                                <button type="submit" name="locale" value="ar" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() == 'ar' ? 'bg-gray-50 font-medium' : '' }} flex items-center justify-between">
                                    <span class="flex items-center">
                                        العربية
                                    </span>
                                    @if(app()->getLocale() == 'ar')
                                        <i class="fas fa-check text-chef-primary"></i>
                                    @endif
                                </button>
                                <button type="submit" name="locale" value="fr" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 {{ app()->getLocale() == 'fr' ? 'bg-gray-50 font-medium' : '' }} flex items-center justify-between">
                                    <span class="flex items-center">
                                        Français
                                    </span>
                                    @if(app()->getLocale() == 'fr')
                                        <i class="fas fa-check text-chef-primary"></i>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div class="dropdown relative">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-chef-primary flex items-center justify-center text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }} text-chef-dark hidden md:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-chef-dark rotate-on-rtl"></i>
                        </button>
                        
                        <div class="dropdown-menu absolute {{ app()->getLocale() == 'ar' ? 'right-0' : 'left-0' }} mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50">
                            <a href="/cook/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-cog {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('إعدادات الحساب') }}
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-right px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('تسجيل الخروج') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="md:hidden {{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }} text-chef-dark">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <a href="{{ route('dashboard') }}" class="block py-2 text-chef-dark hover:text-chef-primary">
                    <i class="fas fa-tachometer-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('اللوحة الرئيسية') }}
                </a>
                <a href="{{ route('cook.dishes.index') }}" class="block py-2 text-chef-dark hover:text-chef-primary">
                    <i class="fas fa-hamburger {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('وجباتي') }}
                </a>
                <a href="{{ route('cook.orders.index') }}" class="block py-2 text-chef-dark hover:text-chef-primary">
                    <i class="fas fa-receipt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('الطلبات') }}
                </a>
                <a href="{{ route('cook.profile') }}" class="block py-2 text-chef-dark hover:text-chef-primary">
                    <i class="fas fa-user {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>{{ __('الملف الشخصي') }}
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-chef-dark text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold flex items-center">
                        <i class="fas fa-utensils {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i> {{ __('ChefZone') }}
                    </h3>
                    <p class="mt-2 text-chef-light opacity-75">{{ __('منصة الطهاة المحترفين') }}</p>
                </div>
                
                <div class="flex space-x-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="#" class="text-chef-light hover:text-chef-primary">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-chef-light hover:text-chef-primary">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-chef-light hover:text-chef-primary">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-chef-light border-opacity-20 mt-6 pt-6 text-center text-sm text-chef-light opacity-75">
                <p>© {{ date('Y') }} ChefZone. {{ __('جميع الحقوق محفوظة') }}</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // Dropdown Menu and Language Switcher
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown');
            const languageSwitcher = document.getElementById('language-switcher');
            const languageMenu = document.getElementById('language-menu');
            
            // Handle user dropdown
            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                button.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
                
                // Close when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdown.contains(event.target)) {
                        menu.classList.add('hidden');
                    }
                });
            });
            
            // Handle language switcher
            if (languageSwitcher && languageMenu) {
                languageSwitcher.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    languageMenu.classList.toggle('hidden');
                });
                
                // Close when clicking outside
                document.addEventListener('click', function(e) {
                    if (!languageSwitcher.contains(e.target) && !languageMenu.contains(e.target)) {
                        languageMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    
    
    @yield('scripts')
</body>
</html>