<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Cook\DishController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Cook\DashboardController as CookDashboardController;
use App\Http\Controllers\Cook\ProfileController as CookProfileController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\DishController as ClientDishController;
use App\Http\Controllers\Client\OrderController ;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
//use App\Http\Controllers\Cook\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Client\FavoriteController;

// 🌐 المسارات العامة
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-dishes', [DishController::class, 'search'])->name('search.dishes');

// 📝 مسارات التسجيل المخصصة
Route::controller(RegisteredUserController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

// ✅ إعادة توجيه /dashboard حسب الدور
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return auth()->user()->role === 'cook'
        ? redirect()->route('cook.dashboard')
        : redirect()->route('client.dashboard');
})->name('dashboard');

// 🍳 مسارات الطباخين
Route::prefix('cook')
    ->middleware(['auth', 'verified'])
    ->name('cook.')
    ->group(function () {
        Route::get('/dashboard', [CookDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [CookProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [CookProfileController::class, 'edit'])->name('profile.edit');
        Route::match(['post', 'patch'], '/profile', [CookProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [CookProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('dishes', DishController::class);
    });

    Route::middleware(['auth', 'verified'])->prefix('cook')->name('cook.')->group(function () {
        Route::get('orders', [\App\Http\Controllers\Cook\OrderController::class, 'index'])->name('orders.index');
        Route::put('orders/{order}', [\App\Http\Controllers\Cook\OrderController::class, 'update'])->name('orders.update');
        Route::resource('dishes', DishController::class)->except(['show']);
        Route::get('/is-profile-complete', [CookProfileController::class, 'isProfileComplete'])->name('profile.isComplete');
    });

    
    
    
    

// 👤 مسارات العملاء
Route::prefix('client')
    ->middleware(['auth', 'verified', /*'role:client'*/]) // تأكد تكون عندك middleware للـ client إذا كنت باغي الحماية
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::get('orders/create/{cook}/{dish}', [\App\Http\Controllers\Client\OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [\App\Http\Controllers\Client\OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders', [\App\Http\Controllers\Client\OrderController::class, 'index'])->name('orders.index'); // Added this route
        Route::get('/orders/{order}', [\App\Http\Controllers\Client\OrderController::class, 'show'])->name('orders.show'); // Added this route
        Route::get('/dishes', [ClientDishController::class, 'index'])->name('dishes.index');
        //Route::get('/profile', [ClientProfileController::class, 'edit'])->name('profile.edit');
        //Route::patch('/profile', [ClientProfileController::class, 'update'])->name('profile.update');
        //Route::delete('/profile', [ClientProfileController::class, 'destroy'])->name('profile.destroy');
        Route::middleware(['auth'])->group(function () {
            Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
            Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        });
    });

    Route::post('/language-switch', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
    Route::get('/test-image', function() {
    return response()->file(storage_path('app/public/dishes/1IzyIfdJvKz4wjpRohwFV53YrJ4wGYXgn7NYQqnd.png'));
});

    


require __DIR__.'/auth.php';
