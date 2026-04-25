<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

// Customer Controllers
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;

// Admin Controllers
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Home / Landing
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==============================================
// ROUTE UNTUK CUSTOMER (Pembeli)
// ==============================================

Route::middleware(['auth'])->group(function () {
    
    // Shop / Toko
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');
    
    // Cart / Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // Orders / Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{transaction}', [OrderController::class, 'show'])->name('orders.show');
    
    // CEK STATUS PEMBAYARAN MANUAL (POLLING)
    Route::get('/cek-pembayaran/{order_id}', [OrderController::class, 'cekStatus'])->name('cek.pembayaran');
    
    // Dashboard Bawaan Breeze
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.products.index');
        }
        return redirect()->route('shop.index');
    })->name('dashboard');
});

// ==============================================
// ROUTE UNTUK ADMIN (Penjual)
// ==============================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Manajemen Produk
    Route::resource('products', ProductController::class);
    
    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{transaction}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{transaction}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ==============================================
// AUTH ROUTES (Bawaan Breeze)
// ==============================================

require __DIR__.'/auth.php';