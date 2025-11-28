<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

// ## PUBLIC ROUTES ##

// Public Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switcher route
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');


// ## AUTHENTICATED ROUTES ##
Route::middleware([
    'auth', // Use the standard web auth guard
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Main dashboard route
    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

    // --- User Cart Routes ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // --- User Wishlist Routes --- (MOVED TO THE CORRECT SECTION)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');


    // ## ADMIN-ONLY ROUTES ##
    Route::middleware(['is_admin'])->group(function () {

        // --- Admin Product Management ---
        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index')->name('products.index');
            Route::get('products/create', 'create')->name('products.create');
            Route::post('products', 'store')->name('products.store');
            Route::delete('products/{id}', 'destroy')->name('products.delete');
        });
    });
});