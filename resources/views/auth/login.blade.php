<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-orange-50 to-amber-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-16 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ __('Chef Platform Logo') }}">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                {{ __('تسجيل الدخول إلى حسابك') }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                {{ __('أو') }}
                <a href="{{ route('register') }}" class="font-medium text-amber-600 hover:text-amber-500">
                    {{ __('إنشاء حساب جديد') }}
                </a>
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-lg rounded-lg sm:px-10 border border-amber-100">
                <form class="mb-0 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            {{ __('البريد الإلكتروني') }}
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   class="focus:ring-amber-500 focus:border-amber-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md py-3 px-4 border"
                                   placeholder="{{ __('example@chef.com') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- كلمة المرور -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            {{ __('كلمة المرور') }}
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="current-password"
                                   class="focus:ring-amber-500 focus:border-amber-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md py-3 px-4 border"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- تذكرني ونسيت كلمة المرور -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                   class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                            <label for="remember_me" class="mr-2 block text-sm text-gray-700">
                                {{ __('تذكرني') }}
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-amber-600 hover:text-amber-500">
                                {{ __('نسيت كلمة المرور؟') }}
                            </a>
                        </div>
                    </div>

                    <!-- زر تسجيل الدخول -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150">
                            {{ __('تسجيل الدخول') }}
                        </button>
                    </div>
                </form>

                <!-- تسجيل الدخول عبر وسائل التواصل -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                {{ __('أو سجل الدخول بواسطة') }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div>
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 5.523 4.477 10 10 10 5.523 0 10-4.477 10-10 0-5.523-4.477-10-10-10zm6.563 14.423c-.175.39-.575.7-1.088.7-.51 0-.91-.31-1.088-.7-1.138-2.547-2.85-3.727-4.387-3.727-1.538 0-3.25 1.18-4.388 3.727-.177.39-.577.7-1.088.7-.512 0-.912-.31-1.088-.7-.177-.39-.175-.86.088-1.227 1.763-2.46 4.463-4.073 7.476-4.073 3.013 0 5.713 1.613 7.476 4.073.263.367.265.837.088 1.227zM10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>