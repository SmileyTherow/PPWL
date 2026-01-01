<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Auth / Profile routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Public routes (user-facing)
|--------------------------------------------------------------------------
*/
// Home / landing page (publik) — ambil 8 produk terbaru
Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('user.home', compact('products'));
})->name('home');

// /home -> redirect ke landing page
Route::get('/home', function () {
    return redirect()->route('home');
})->name('home.redirect');

/*
|--------------------------------------------------------------------------
| Public product routes
| - products.index dan products.show untuk akses publik
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Cart & Checkout (publik)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

/*
|--------------------------------------------------------------------------
| Order routes (user history) - but hanya untuk user yang login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Admin routes (resource management)
| - resource routes di-prefiks /admin, nama route diawali admin.
| - gunakan middleware 'admin' (pastikan sudah didaftarkan).
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // admin home (mis. /admin)
    Route::get('/', function () {
        return view('home'); // sesuaikan view admin kalau perlu
    })->name('home');

    // resource untuk admin mengelola category & products (route names: admin.category.*, admin.products.*)
    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| Single dashboard route (dipakai oleh Auth redirect)
| - Pastikan hanya satu definisi route 'dashboard' agar tidak error saat login.
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard'); // buat resources/views/dashboard.blade.php jika belum ada
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth scaffolding (Laravel Breeze / Jetstream / Fortify etc.)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])
    ->name('checkout.sukses')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::put(
        '/checkout/{order}/payment-proof',
        [CheckoutController::class, 'updatePaymentProof']
    )->name('checkout.updatePaymentProof');

    Route::get(
        '/checkout/sukses',
        [CheckoutController::class, 'sukses']
    )->name('checkout.sukses');
});

