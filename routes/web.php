<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('user.products');
Route::get('/products/{product}', [HomeController::class, 'showProduct'])->name('user.products.show');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('products', 'index')->name('products.index');
            Route::get('products/create', 'create')->name('products.create');
            Route::post('products', 'store')->name('products.store');
            Route::get('editProduct/{id}', 'edit')->name('products.edit');
            Route::put('updateProduct/{id}', 'update')->name('products.update');
            Route::delete('products/{id}', 'destroy')->name('products.delete');
        });
    });
});