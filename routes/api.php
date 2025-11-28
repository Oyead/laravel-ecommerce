<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// === PUBLIC ROUTES ===
// These routes are accessible without an API token.
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');


// === PROTECTED ROUTES ===
// These routes require a valid API token (from Sanctum) to be accessed.
Route::middleware('auth:sanctum')->group(function () {

    // A standard route to get the authenticated user's details
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // The API logout route is now protected
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // All product management routes are now protected
    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index')->name('api.products.index');
        Route::get('products/show/{id}', 'show')->name('api.products.show');
        Route::post('products', 'store')->name('api.products.store');
        Route::put('products/update/{id}', 'update')->name('api.products.update');
        Route::delete('products/delete/{id}', 'destroy')->name('api.products.delete');
    });
});