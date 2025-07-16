<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:client,cook'],
    ]);

    DB::beginTransaction(); // نبدأ معاملة آمنة

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($user->role === 'client') {
            \App\Models\Client::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => 'غير محدد', // أو قيمة افتراضية مناسبة
            ]);
        } else {
            \App\Models\Cook::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email' => $user->email,
                'country_id' => null,
                'city_id' => null,
                'food_types' => json_encode([]),
                'sample_image' => null,
            ]);
        }

        DB::commit(); // إذا وصلنا هنا، كل شيء تمام

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route(
            $user->role === 'cook' ? 'cook.profile' : 'client.dashboard'
        );

    } catch (\Exception $e) {
        DB::rollBack(); // فشل؟ نرجع كل شيء
        return back()->withErrors(['general' => 'حدث خطأ أثناء إنشاء الحساب، يرجى المحاولة مجددًا.'])->withInput();
    }
}
}
