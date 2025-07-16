@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md p-4">
    <h2 class="text-2xl font-bold mb-4">{{ __('إنشاء حساب جديد') }}</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">{{ __('الاسم الكامل') }}</label>
            <input type="text" name="name" class="w-full border p-2 rounded @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">{{ __('البريد الإلكتروني') }}</label>
            <input type="email" name="email" class="w-full border p-2 rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">{{ __('كلمة المرور') }}</label>
            <input type="password" name="password" class="w-full border p-2 rounded @error('password') border-red-500 @enderror" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">{{ __('تأكيد كلمة المرور') }}</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">{{ __('نوع المستخدم') }}</label>
            <select name="role" id="role" class="w-full border p-2 rounded @error('role') border-red-500 @enderror" required>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>{{ __('عميل') }}</option>
                <option value="cook" {{ old('role') == 'cook' ? 'selected' : '' }}>{{ __('طاهٍ') }}</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('إنشاء الحساب') }}</button>
    </form>
</div>
@endsection
